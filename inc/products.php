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
    return fetch_from_database($product_id, 'select name, price, img, sku, paypal from products where sku=?;');
}


function get_product_sizes($product_id) {

    return fetchAll_from_database($product_id,
        'select product_sku, size from products_sizes 
        join sizes on products_sizes.size_id = sizes.id 
        where product_sku=? order by sizes.order;
        ');   
}

// Returns the total number of products
function get_products_count() {

    require(ROOT_PATH . 'inc/database.php');

    try {
      $result = $db->query('select count(sku) number from products;');
    } catch (Exception $e) {
        echo 'Problem querying database: ' . $e->getMessage();
        exit;
    }

    return intval($result->fetch(PDO::FETCH_ASSOC)['number']);
}


// Returns a subset number of products with indices in
// the range start..end inclusive
function get_products_subset($start, $end) {
    $sku_base = 100;
    $start += $sku_base;
    $end += $sku_base;

    require(ROOT_PATH . 'inc/database.php');

    try {
      $stmt = $db->prepare('select * from products where sku >= ? and sku <= ?;');
      $stmt->bindParam(1, $start);
      $stmt->bindParam(2, $end);
      $stmt->execute();
    } catch (Exception $e) {
        echo "Unable to read product details from the database.";
        return false;
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

/*
*  @return   array       a list of the last four products in the database
*/
function get_products_recent() {

    return query_database('select * from products order by sku desc limit 4;');
}

// Searches through all product names for the search term
// Returns a list of found matches
function get_products_search($s) {
    // A bit of juggling is required to use SQL wildcards in a prepared statement
    $s = "%".$s."%";
    return fetchAll_from_database($s, "select * from products where name like ?;");
}

// Returns all the products in the database
function get_products_all() {
    return query_database('select name, price, img, sku, paypal from products order by sku asc;');
}


/*
*   Returns a list of items matching the query string
*/
function query_database($query) {

    require(ROOT_PATH . 'inc/database.php');

    try {
      $results = $db->query($query);
    } catch (Exception $e) {
        echo 'Problem querying database: ' . $e->getMessage();
        exit;
    }
    $items = $results->fetchAll(PDO::FETCH_ASSOC);

    return $items;
}


/*
 * Searches the database by generating a prepared statement with one injected
 * parameter.
 * @param   mixed           the prepared statement injected variable
 * @return  query result    the matching result
*/
function fetch_from_database($param, $stmt) {

    require(ROOT_PATH . 'inc/database.php');

    try {
      $stmt = $db->prepare($stmt);
      $stmt->bindParam(1, $param);
      $stmt->execute();
    } catch (Exception $e) {
        echo "Unable to read product details from the database.";
        return false;
    }
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/*
 * Searches the database by generating a prepared statement with one injected
 * parameter.
 * @param   mixed       the prepared statement injected variable
 * @return  array       a list of matching results
*/
function fetchAll_from_database($param, $stmt) {

    require(ROOT_PATH . 'inc/database.php');

    try {
      $stmt = $db->prepare($stmt);
      $stmt->bindParam(1, $param);
      $stmt->execute();
    } catch (Exception $e) {
        echo "Unable to read product details from the database.";
        return false;
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
