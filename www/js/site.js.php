<?php

require_once '../../vendor/autoload.php';

use Assetic\Asset\FileAsset;
use Assetic\Factory\AssetFactory;
use Assetic\AssetManager;
use Assetic\FilterManager;
use Assetic\Filter\Yui\JsCompressorFilter;


$filterManager = new FilterManager();
$filterManager->set('yui_js', new JsCompressorFilter('../../java/yuicompressor-2.4.7.jar'));

$assetManager = new AssetManager();

// Sets the jquery AM
$assetManager->set(
    'jquery',
    new FileAsset('../javascripts/jquery-1.8.3.js')
);

$assetFactory = new AssetFactory('../');

// uncomment the next line to enable debug mode
//$assetFactory->setDebug(true); // with this all filters with ? before the filter name will not be used

$assetFactory->setAssetManager($assetManager);
$assetFactory->setFilterManager($filterManager);

$js = $assetFactory->createAsset(
    array(
         '@jquery',
         'javascripts/twitter-bootstrap/*.js'
    ),
    array(
         '?yui_js'
    )
);


header('Content-Type: application/javascript');
echo $js->dump();
