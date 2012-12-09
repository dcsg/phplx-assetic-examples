<?php

require_once '../../vendor/autoload.php';

use Assetic\Asset\FileAsset;
use Assetic\Filter\Yui\CssCompressorFilter;
use Assetic\Filter\CompassFilter;

$yuiFilter = new CssCompressorFilter('../../java/yuicompressor-2.4.7.jar');
$compassFilter = new CompassFilter();

$cssAsset = new FileAsset(
    '../sass/screen.scss',
    array($compassFilter, $yuiFilter)
);

header('Content-Type: text/css');
echo $cssAsset->dump();
