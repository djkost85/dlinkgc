<?php

namespace Dlinkgc;

use Dlinkgc\Detector\DetectorBag;
use Dlinkgc\Detector\DetectorInterface;
use Dlinkgc\Crawler\Crawler;
use Dlinkgc\Link;
use Buzz\Message;
use Buzz\Client;

class GarbageCollector
{
    protected $detectorBag;
    protected $messageFactory;
    protected $client;

    public function __construct(DetectorBag $detectorBag = null, 
                                Message\FactoryInterface $factory = null,
                                Client\BatchClientInterface $client = null)
    {
        $this->detectorBag = $detectorBag ?: new DetectorBag($this->getDefaultDetectors());
        $this->messageFactory = $factory ?: new Message\Factory();
        $this->client = $client ?: new Client\MultiCurl();
    }

    public function detectCrawler($url)
    {
        foreach ($this->detectorBag->getIterator() as $detector) {
            if ($detector->verify($url)) {
                return $detector->getName();
            }
        }
    }

    public function getCrawler(Link $link)
    {
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

        $link->setCrawler($crawler);
    }

    public function collect($links)
    {
        if (! is_array($links)) $links = array($links);

        $_links = array();

        foreach($links as $link) {
            if (! $link instanceof Link) $link = new Link($link);

            if (isset($_links[$link->getUrl()])) break;
            
            if (! $link->getCrawler())
                $this->getCrawler($link);

            $this->addToClientQueue($link);

            $_links[$link->getUrl()] = $link;
        }

        $this->client->flush();

        foreach($_links as $link)
            $this->crawlLink($link);

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

    protected function addToClientQueue(Link $link)
    {
        $request = $this->messageFactory->createRequest();
        $request->fromUrl($link->getUrl());

        $response = $this->messageFactory->createResponse();

        $crawler = $link->getCrawler();
        $crawler->setRequest($request)->setResponse($response);

        $this->client->send($crawler->getRequest(), $crawler->getResponse());
    }

    protected function crawlLink(Link $link)
    {
            $http_status = $link->getCrawler()->getResponse()->getStatusCode();

            if (empty($http_status))
                $status = Link::NO_STATUS;

            if (500 <= $http_status)
                $status = Link::SCHRO_STATUS;
            elseif (200 >= $http_status && $http_status < 300)
                $status = $link->getCrawler()->execute() ? Link::ALIVE_STATUS : Link::DEAD_STATUS;
            else
                $status = Link::DEAD_STATUS;

            $link->setStatus($status);
    }

    protected function getDefaultDetectors()
    {
        return array(
            new Detector\MegaUploadDetector(),
            new Detector\FileSonicDetector(),
            //new Detector\RapidShareDetector(),
            new Detector\UnFichierDetector(),
            new Detector\DepositfilesDetector(),
            new Detector\FileserveDetector(),
            new Detector\GigaupDetector(),
            new Detector\UploadhereDetector(),
            new Detector\UploadkingDetector(),
            new Detector\UptoboxDetector(),
            new Detector\MultiuploadDetector(),
            new Detector\HotfileDetector(),
            new Detector\UploadingDetector(),
            new Detector\FilejungleDetector(),
        );
    }
}