<?php

	require_once("../inc/config.php");
	require_once(ROOT_PATH . "inc/products.php");

if (isset($_GET["pg"])) {
	$current_page = $_GET["pg"];
} else {
	$current_page = 1;
}
$current_page = intval($current_page);

$total_products = get_products_count();
$products_per_page = 8;
$total_pages = ceil($total_products / $products_per_page);

if ($current_page > $total_products) {
	header("Location: ./?pg=" . $total_pages);
} elseif ($current_page < 1) {
	header("Location: ./");
}

$start = $products_per_page * ($current_page - 1) + 1;
$end = $products_per_page * $current_page;

if ($end > $total_products) {
	$end = $total_products;
}

$products = get_products_subset($start, $end);

?><?php 
$pageTitle = "Mike's Full Catalog of Shirts";
$section = "shirts";
include(ROOT_PATH . 'inc/header.php'); ?>

		<div class="section shirts page">

			<div class="wrapper">

				<h1>Mike&rsquo;s Full Catalog of Shirts</h1>

				<?php include(ROOT_PATH ."inc/list-navigation.html.php"); ?>

				<ul class="products">
					<?php foreach($products as $product) { 
						include(ROOT_PATH . 'inc/list_view.html.php');
						}
					?>
				</ul>

				<?php include(ROOT_PATH ."inc/list-navigation.html.php"); ?>

			</div>

		</div>

<?php include(ROOT_PATH . 'inc/footer.php') ?>
