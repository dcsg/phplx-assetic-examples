<?php

require_once '../../vendor/autoload.php';

use Assetic\Asset\FileAsset;
use Assetic\Asset\AssetCollection;
use Assetic\AssetManager;
use Assetic\FilterManager;
use Assetic\Asset\GlobAsset;
use Assetic\Filter\Yui\JsCompressorFilter;


$filterManager = new FilterManager();
$filterManager->set('yui_js', new JsCompressorFilter('../../java/yuicompressor-2.4.7.jar'));

$assetManager = new AssetManager();
$assetManager->set(
    'twitter_bootstrap',
    new AssetCollection(
        array(
             new FileAsset('../javascripts/jquery-1.8.3.js'),
             new GlobAsset('../javascripts/twitter-bootstrap/*.js')
        ),
        array($filterManager->get('yui_js'))
    )
);

header('Content-Type: application/javascript');
echo $assetManager->get('twitter_bootstrap')->dump();
