<?php

function get_list_view_html($product) {
    
    $output = "";

    $output = $output . "<li>";
    $output = $output . '<a href="' . BASE_URL . 'shirts/' . $product["sku"] . '/">';
    $output = $output . '<img src="' . BASE_URL . $product["img"] . '" alt="' . $product["name"] . '">';
    $output = $output . "<p>View Details</p>";
    $output = $output . "</a>";
    $output = $output . "</li>";

    return $output;
}

/* Returns the product matching the product id if found
* or false
* @param    int     $product_id the product id, or 'sku'
* @return   mixed   the matched product
*           bool    false if not product found
*/
function get_product_single($product_id) {

    require(ROOT_PATH . 'inc/database.php');

    try {
      $stmt = $db->prepare('select name, price, img, sku, paypal from products where sku=?;');
      $stmt->bindParam(1, $product_id);
      $stmt->execute();
    } catch (Exception $e) {
        echo "Unable to read product details from the database.";
        return false;
    }
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_product_sizes($product_id) {

    require(ROOT_PATH . 'inc/database.php');

    try {
      $stmt = $db->prepare('
        select product_sku, size from products_sizes 
        join sizes on products_sizes.size_id = sizes.id 
        where product_sku=? order by sizes.order;
        ');

      $stmt->bindParam(1, $product_id);
      $stmt->execute();
    } catch (Exception $e) {
        echo "Unable to read product sizes from the database.";
        return false;
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);    
}

// Returns the total number of products
function get_products_count() {
    return count(get_products_all());
}

// Returns a subset number of products with indices in
// the range start..end inclusive
function get_products_subset($start, $end) {
    $subset = [];
    $all = get_products_all();

    $position = 0;
    foreach ($all as $product) {
        $position += 1;
        if ($position >= $start && $position <= $end) {
            $subset[] = $product;
        }
    }
    return $subset;
}

// Returns the 4 most recent products
function get_products_recent() {
    $recent = array();
    $all = get_products_all();

    $total_products = count($all);
    $position = 0;
    
    foreach($all as $product) {
        $position = $position + 1;
        if ($total_products - $position < 4) {
            $recent[] = $product;
        }
    }
    return $recent;
}

// Searches through all product names for the search term
// Returns a list of found matches
function get_products_search($s) {
    $results = [];
    $products = get_products_all();
    foreach($products as $product) {
        if (stripos($product["name"], $s) !== false) {
            $results[] = $product;
        }
    }
    return $results;
}

// Returns all the products in the database
function get_products_all() {

    require(ROOT_PATH . 'inc/database.php');

    try {
      $results = $db->query('select name, price, img, sku, paypal from products order by sku asc;');
    } catch (Exception $e) {
        echo 'Problem querying database: ' . $e->getMessage();
        exit;
    }

    $products = $results->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}

?>
