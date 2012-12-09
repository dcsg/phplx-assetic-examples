<?php

require_once '../../vendor/autoload.php';

use Assetic\Asset\FileAsset;
use Assetic\Asset\AssetCollection;
use Assetic\Filter\LessFilter;
use Assetic\Filter\Yui\CssCompressorFilter;
use Assetic\Filter\CompassFilter;

$yuiFilter     = new CssCompressorFilter('../../java/yuicompressor-2.4.7.jar');
$compassFilter = new CompassFilter('/usr/bin/compass');
$lessFilter    = new LessFilter('/usr/local/bin/node', array('/usr/local/lib/node_modules'));

$cssAC = new AssetCollection(
    array(
         new FileAsset(
             '../sass/screen.scss',
             array($compassFilter)
         ),
         new FileAsset(
             '../less/twitter-bootstrap/bootstrap.less',
             array($lessFilter)

         )
    ),
    array($yuiFilter)
);


header('Content-Type: text/css');
echo $cssAC->dump();
