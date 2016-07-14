<?php

/*

TODO:

- kuva(t) poistuu muokatessa!!

- salasanan vaihto
- tuotteen 'piilottaminen'
- aikavyöhykkeet
- yhtenäistä login-sivu indexin kanssa
- kirjoita ohjeet loppuun

TOIMII:

- tuotteiden kuvauksen muokkaus toimii
- tuotteiden lisäys ja poisto
- kuvien lisäys ja poisto, myös muokatessa

*/

$url = (isset($_GET["p"]) ? $_GET["p"] : "index");
$action = (isset($_GET["action"])) ? $_GET["action"] : "none";
$id = (isset($_GET["id"])) ? $_GET["id"] : 0;

require_once("config.php");
require_once("includes/init.php");

require_once("Controllers/" .ucfirst($url). ".php");
require_once("Libs/Model.php");
require_once("Libs/View.php");

$app = new $url($action, $id);