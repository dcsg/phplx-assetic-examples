<?php

require_once '../../vendor/autoload.php';

use Assetic\Asset\FileAsset;
use Assetic\Asset\AssetCollection;
use Assetic\AssetManager;
use Assetic\FilterManager;
use Assetic\Filter\LessFilter;
use Assetic\Filter\Yui\CssCompressorFilter;
use Assetic\Filter\CompassFilter;


$filterManager = new FilterManager();
$filterManager->set('yui_css', new CssCompressorFilter('../../java/yuicompressor-2.4.7.jar'));
$filterManager->set('compass', new CompassFilter('/usr/bin/compass'));
$filterManager->set('less', new LessFilter('/usr/local/bin/node', array('/usr/local/lib/node_modules')));

$assetManager = new AssetManager();
$assetManager->set('3rd_party',
    new AssetCollection(
        array(
             new FileAsset(
                 '../sass/screen.scss',
                 array($filterManager->get('compass'))
             ),
             new FileAsset(
                 '../less/twitter-bootstrap/bootstrap.less',
                 array($filterManager->get('less'))

             )
        ),
        array($filterManager->get('yui_css'))
    )
);

header('Content-Type: text/css');
echo $assetManager->get('3rd_party')->dump();
