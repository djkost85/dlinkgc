<?php

namespace Dlinkgc\Detector;

class DetectorBag
{
    protected $detectors = array();

    public function __construct(array $detectors = null)
    {
        if ($detectors) {
            foreach ($detectors as $detector)
                $this->addDetector($detector);
        }
    }

    public function addDetector(DetectorInterface $detector)
    {
        if (! $detector->getName())
            throw new \Exception(sprintf("getName method of %s cannot return an empty string", get_class($detector)));
            
        $this->detectors[(string) $detector->getName()] = $detector;
    }

    public function hasDetector($detector)
    {
        $detector = $this->detectorToString($detector);

        if (isset($this->detectors[$detector]))
            return true;

        return false;
    }

    public function getDetector($detector)
    {
        $detector = $this->detectorToString($detector);

        if (isset($this->detectors[$detector]))
            return $this->detectors[$detector];

        return null;
    }

    public function getDetectors()
    {
        return $this->detectors;
    }

    public function removeDetector($detector)
    {
        $detector = $this->detectorToString($detector);

        unset($this->detectors[$detector]);
    }

    protected function detectorToString($detector)
    {
        if ($detector instanceof DetectorInterface)
            $detector = $detector->getName();

        return $detector;
    }


}