<?php 

require_once('includes/config.php');

$pageTitle = "Home";
$siteName = "Shirts 4 Mike";
$section = "";
include(ROOT_PATH .'includes/header.php');

?>
		<div class="section banner">
			<div class="wrapper">
				<img class="hero" src="img/mike-the-frog.png" alt="Mike the Frog says:">
				<div class="button">
					<a href="<?php echo BASE_URL; ?>shirts.php">
						<h2>Hey, I&rsquo;m Mike!</h2>
						<p>Check Out My Shirts</p>
					</a>
				</div>
			</div>
		</div>

		<div class="section shirts latest">
			<div class="wrapper">
				<h2>Mike&rsquo;s Latest Shirts</h2>

				<?php require_once(ROOT_PATH .'includes/products.php'); ?>

				<ul class="products">
				<?php 
					$total_products = count($products);
					$position = 0;
					$list_view = "";
					foreach ($products as $product_id => $product) { 
						$position = $position + 1;
						if ($total_products - $position < 4) {
						  $list_view = get_list_view_html($product_id, $product) . $list_view;
						}
					 }
					 echo $list_view; 
				 ?>				
				</ul>
			</div>
		</div>

<?php include(ROOT_PATH .'includes/footer.php'); ?>
