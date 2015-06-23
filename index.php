<?php 

require_once('includes/config.php');
require_once(ROOT_PATH .'includes/products.php');
$recent_products = get_recent_products(4);
					
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

				<ul class="products">
				<?php 
					$list_view = "";
					foreach ($recent_products as $product) { 
					  $list_view = get_list_view_html($product) . $list_view;
					 }
					 echo $list_view; 
				 ?>				
				</ul>
			</div>
		</div>

<?php include(ROOT_PATH .'includes/footer.php'); ?>
