<?php

namespace Dlinkgc\Detector;

interface DetectorInterface
{
    public function verify($url);

    public function getCrawler();

    public function getName();
}