<?php

require_once '../../vendor/autoload.php';

use Assetic\Asset\FileAsset;
use Assetic\Asset\AssetCollection;
use Assetic\Asset\AssetReference;
use Assetic\AssetManager;
use Assetic\FilterManager;
use Assetic\Asset\GlobAsset;
use Assetic\Filter\Yui\JsCompressorFilter;


$filterManager = new FilterManager();
$filterManager->set('yui_js', new JsCompressorFilter('../../java/yuicompressor-2.4.7.jar'));

$assetManager = new AssetManager();

// Sets the jquery AM
$assetManager->set(
    'jquery',
    new FileAsset('../javascripts/jquery-1.8.3.js'),
    array($filterManager->get('yui_js'))
);

// Sets the twitter bootstrap AM that will referencing the jquery AM
$assetManager->set(
    'twitter_bootstrap',
    new AssetCollection(
        array(
             new AssetReference($assetManager, 'jquery'),
             new GlobAsset('../javascripts/twitter-bootstrap/*.js')
        ),
        array($filterManager->get('yui_js'))
    )
);

header('Content-Type: application/javascript');
echo $assetManager->get('twitter_bootstrap')->dump();
