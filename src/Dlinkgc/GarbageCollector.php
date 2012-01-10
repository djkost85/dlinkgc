<?php

namespace Dlinkgc;

use Dlinkgc\Detector\DetectorBag;

class GarbageCollector
{
    protected $detectorBag;

    public function __construct(DetectorBag $detectorBag = null)
    {
        $this->detectorBag = $detectorBag ?: new DetectorBag($this->getDefaultDetectors());
    }

    

    public function getDetectorBag()
    {
        return $this->detectorBag;
    }

    protected function getDefaultDetectors()
    {
        return array(
            new Detector\MegaUploadDetector(),
            new Detector\FileSonicDetector(),
        );
    }
}