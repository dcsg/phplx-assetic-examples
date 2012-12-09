<?php

require_once '../../vendor/autoload.php';

use Assetic\Asset\FileAsset;
use Assetic\Asset\AssetCollection;
use Assetic\Asset\GlobAsset;
use Assetic\Filter\Yui\JsCompressorFilter;

$yuiFilter = new JsCompressorFilter('../../java/yuicompressor-2.4.7.jar');

$jsAC = new AssetCollection(
    array(
         new FileAsset(
             '../javascripts/jquery-1.8.3.js'
         ),
         new GlobAsset('../javascripts/twitter-bootstrap/*.js')
    ),
    array($yuiFilter)
);


header('Content-Type: application/javascript');
echo $jsAC->dump();
