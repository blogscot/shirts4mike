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
      echo '<li><a href="shirt.php?id='. $product_id .'">';
        ?>
          <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
      <?php 
      echo '<p>View Details</p></a></li>';
       } ?>
    </ul>

  </div>
</div>

<?php include('includes/footer.php'); ?>

