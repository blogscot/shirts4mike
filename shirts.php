<?php 

include ("includes/products.php");

$pageTitle = "Shirts";
$siteName = "Shirts 4 Mike";
$section = "shirts";
include('includes/header.php'); ?>

<div class="section shirts page">

  <div class="wrapper">
    <h1>Mike&rsquo;s Full Catalog of Shirts</h1>
  
    <ul class="products">
      <?php foreach ($products as $product_id => $product) { 
        echo get_list_view_html($product_id, $product);
       } ?>
    </ul>

  </div>
</div>

<?php include('includes/footer.php'); ?>

