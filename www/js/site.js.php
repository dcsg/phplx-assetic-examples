<?php

require_once '../../vendor/autoload.php';

use Assetic\Asset\FileAsset;
use Assetic\Filter\Yui\JsCompressorFilter;
$yuiFilter = new JsCompressorFilter('../../java/yuicompressor-2.4.7.jar');

$jsAsset = new FileAsset(
    '../javascripts/jquery-1.8.3.js',
    array($yuiFilter)
);

header('Content-Type: application/javascript');
echo $jsAsset->dump();
