<?php

require_once("inc/config.php");
require_once('inc/products.php');
echo "<pre>";

foreach (get_product_sizes("101") as $size) {
  var_dump($size);
}
