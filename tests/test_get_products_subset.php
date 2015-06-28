<?php

require_once("../inc/config.php");
require_once('../inc/products.php');
echo "<pre>";

$results = get_products_subset(5,10);
var_dump($results);