<?php

require_once("../inc/config.php");
require_once('../inc/products.php');
echo "<pre>";

$results = get_products_search("frog");
var_dump($results);