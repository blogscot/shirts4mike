<?php 

function get_list_view_html($product) {
  $output = '';
  $output = $output . '<li>';
  $output = $output . '<a href="'. BASE_URL .'shirts/' . $product["sku"] .'/">';
  $output = $output . '<img src="'. BASE_URL .$product["img"]. '" alt="'. $product["name"] .'">';
  $output = $output . '<p>View Details</p>';
  $output = $output . '</a>';
  $output = $output . '</li>';
  return $output;
}

// Returns the x most recent products, (where x is $number)
function get_recent_products($number) {
    $products = get_all_products();
    $total_products = count($products);    
    $recent = array();
    $position = 0;

    foreach ($products as $product) { 
        $position = $position + 1;
        if ($total_products - $position < $number) {
            $recent[] = $product;
        }
     } 
    return $recent;
}

function get_all_products() {

  $products = array();
  $products[101] = array(
      "name" => "Logo Shirt, Red",
      "img" => "img/shirts/shirt-101.jpg",
      "price" => 18,
      "paypal" => "NTV9ZVUMZA66A",
      "sizes" => array("Small", "Medium", "Large", "X-Large")
  );
  $products[102] = array(
      "name" => "Mike the Frog Shirt, Black",
      "img" => "img/shirts/shirt-102.jpg",
      "price" => 20,
      "paypal" => "75R4F58CR3Q4U",
      "sizes" => array("Small", "Medium", "Large", "X-Large")
  );
  $products[103] = array(
      "name" => "Mike the Frog Shirt, Blue",
      "img" => "img/shirts/shirt-103.jpg",    
      "price" => 20,
      "paypal" => "BQ2DBC8LE32GW",
      "sizes" => array("Small", "Medium", "Large", "X-Large")
  );
  $products[104] = array(
      "name" => "Logo Shirt, Green",
      "img" => "img/shirts/shirt-104.jpg",    
      "price" => 18,
      "paypal" => "QV8G7FXU2KQBA",
      "sizes" => array("Small", "Medium", "Large", "X-Large")
  );
  $products[105] = array(
      "name" => "Mike the Frog Shirt, Yellow",
      "img" => "img/shirts/shirt-105.jpg",    
      "price" => 25,
      "paypal" => "NE7NNW9V6CY6J",
      "sizes" => array("Small", "Medium", "Large", "X-Large")
  );
  $products[106] = array(
      "name" => "Logo Shirt, Gray",
      "img" => "img/shirts/shirt-106.jpg",    
      "price" => 20,
      "paypal" => "B2R5W59C8U3PL",
      "sizes" => array("Small", "Medium", "Large", "X-Large")
  );
  $products[107] = array(
      "name" => "Logo Shirt, Turquoise",
      "img" => "img/shirts/shirt-107.jpg",    
      "price" => 20,
      "paypal" => "ZZVMAJP4FFC2N",
      "sizes" => array("Small", "Medium", "Large", "X-Large")
  );
  $products[108] = array(
      "name" => "Logo Shirt, Orange",
      "img" => "img/shirts/shirt-108.jpg",    
      "price" => 25,
      "paypal" => "2BMBNRUPMB3KY",
      "sizes" => array("Large", "X-Large")
  );

  foreach ($products as $product_id => $product) {
      $products[$product_id]["sku"] = $product_id;
  }
  return $products;
}


?>
