<?php

namespace Dlinkgc\Detector;

class DetectorBag implements \ArrayAccess
{
    protected $values = array();

    public function __construct(array $detectors = null)
    {
        if ($detectors) {
            foreach($detectors as $detector)
                $this->offsetSet(null, $detector);
        }
    }

    public function offsetSet($id = null, $detector)
    {
        if (! $detector instanceof DetectorInterface)
            throw new \InvalidArgumentException(sprintf("value must be an instance of Dlinkgc\Detector\DetectorInterface, (%s) `%s` given", gettype($detector), $detector));
        

        if (! $detector->getName())
            throw new \LogicException(sprintf("getName method of %s can not return an empty string", get_class($detector)));

        $id = is_null($id) ? (string) $detector->getName() : $id;

        $this->values[$id] = $detector;
    }

    public function offsetGet($id)
    {
        $id = $this->getDetectorName($id);

        if (! array_key_exists($id, $this->values))
            throw new \InvalidArgumentException(sprintf('Identifier "%s" is not defined.', $id));

        return $this->values[$id];
    }

    public function offsetExists($id)
    {
        return isset($this->values[$this->getDetectorName($id)]);
    }

    public function offsetUnset($id)
    {
        unset($this->values[$this->getDetectorName($id)]);
    }

    public function getAll()
    {
        return $this->values;
    }

    protected function getDetectorName($detectorName)
    {
        if ($detectorName instanceof DetectorInterface)
            $detectorName = $detectorName->getName();

        return $detectorName;
    }
}