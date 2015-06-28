<?php

require_once("../inc/config.php");
require_once('../inc/products.php');
echo "<pre>";

$result = get_products_count();
var_dump($result);
