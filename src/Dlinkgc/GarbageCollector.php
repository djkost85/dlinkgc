<?php

namespace Dlinkgc;

use Dlinkgc\Detector\DetectorBag;
use Dlinkgc\Detector\DetectorInterface;
use Dlinkgc\Crawler\Crawler;
use Dlinkgc\Link;
use Buzz\Message\Factory;
use Buzz\Client\MultiCurl as Client;

class GarbageCollector
{
    protected $detectorBag;
    protected $messageFactory;
    protected $client;

    public function __construct(DetectorBag $detectorBag = null)
    {
        $this->detectorBag = $detectorBag ?: new DetectorBag($this->getDefaultDetectors());
        $this->messageFactory = new Factory();
        $this->client = new Client();
    }

    public function detectCrawler($url)
    {
        foreach ($this->detectorBag->getAll() as $detector) {
            if ($detector->verify($url)) {
                return $detector->getName();
            }
        }
    }

    public function collect($links)
    {
        if (! is_array($links)) $links = array($links);

        $_links = array();

        foreach($links as $link) {
            if (! $link instanceof Link) $link = new Link($link);

            // if (! filter_var($url, FILTER_VALIDATE_URL))
            //     throw new \Exception(sprintf("The URL `%s` has wrong format", $url));
                
            $crawler = null;
            if ($link->getDetector() && $detector = $this->getDetector($link->getDetector())) {
                $crawler = $detector->getCrawler();
            }
            else {
                if ($detector = $this->getDetector($this->detectCrawler($link->getUrl()))) {
                    $link->setDetector($detector->getName());
                    $crawler = $detector->getCrawler();
                }
            }
            
            if (is_null($crawler)) {
                $detector = new Detector\CommonDetector();
                $crawler = $detector->getCrawler();
            }

            if (! $crawler instanceof Crawler)
                        throw new \Exception(sprintf("%s::getCrawler method must return an instance of Dlinkgc\Crawler\Crawler", get_class($detector)));

            $link->setCrawler($crawler);
            $this->addToQueue($link);

            $_links[$link->getUrl()] = $link;
        }

        $this->client->flush();

        foreach($_links as $link) {
            
            $http_status = $link->getCrawler()->getResponse()->getStatusCode();
            if (500 <= $http_status)
                $status = Link::SCHRO_STATUS;
            elseif (200 >= $http_status && $http_status < 300)
                $status = $link->getCrawler()->execute() ? Link::ALIVE_STATUS : Link::DEAD_STATUS;
            else
                $status = Link::DEAD_STATUS;

            $link->setStatus($status);
        }

        return $_links;
    }



    public function addDetector(DetectorInterface $detector)
    {
        $this->detectorBag[] = $detector;

        return $this;
    }

    public function addDetectors(array $detectors)
    {
        foreach ($detectors as $detector)
            $this->addDetector($detector);

        return $this;
    }

    public function getDetectorBag()
    {
        return $this->detectorBag;
    }

    public function getDetector($detectorName)
    {
        if (isset($this->detectorBag[$detectorName]))
            return $this->detectorBag[$detectorName];
        
        return null;
    }

    protected function addToQueue(Link $link)
    {
        $request = $this->messageFactory->createRequest();
        $request->fromUrl($link->getUrl());

        $response = $this->messageFactory->createResponse();

        $crawler = $link->getCrawler();
        $crawler->setRequest($request)->setResponse($response);

        $this->client->send($crawler->getRequest(), $crawler->getResponse());
    }

    protected function getDefaultDetectors()
    {
        return array(
            new Detector\MegaUploadDetector(),
            new Detector\FileSonicDetector(),
        );
    }
}