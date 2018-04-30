<?php

/**
 * Database connection and CRUD queries
 * 
 */

/** 
 * connect_db
 * Connect DB and Return connection
 * 
 */
function connect_db(){
    /*
    define('HOSTNAME', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', 'root');
    define('DBNAME', 'pitstop');
     */
    $host = 'localhost';
    $user = 'root';
    $pw = '';
    $dbName = 'pitstop';
    $conn = new mysqli($host, $user, $pw, $dbName);
    
    if ($conn) {
        logging(__FILE__, __LINE__, "Succeeded  to Connect to  MySQL-" . $conn->connect_error);
        return $conn;
    } else {
        logging(__FILE__, __LINE__, "Failed to Connect to MySQL-" . $conn->connect_error);
        return null;
    }
}

/** 
 * disconnect_db
 * Disconnect DB connection
 */
function disconnect_db($conn){
    $conn->close();    
}

/** 
 * get_categories
 * Get All categories list
 */
function get_categories(){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    $sql = "SELECT DISTINCT(categoryId), category from products";
    logging(__FILE__, __LINE__, $sql);
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result != null && $result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
        
    return null;
}

/** 
 * get_product_image_src
 * Get brands list
 * 
 */
function get_brands(){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    $sql = "SELECT DISTINCT(brandId), brand from products";
    logging(__FILE__, __LINE__, $sql);
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result != null && $result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
        
    return null;
}
/** 
 * get_product_image_src
 * Get brands list with $category
 * @param $category
 */
function get_brands2($categoryarr){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    $sql = "SELECT DISTINCT(brandId), brand from products";
    if (count($categoryarr) > 0){
        $category_where = "";
        foreach($categoryarr as $category){
            if ($category === "")   continue;
            if($category_where != "")
                $category_where .= " OR ";
            
            $category_where .= "categoryId = '" . $category . "'";
        }
        
        if ($category_where !== ""){
            $sql .= " WHERE " . $category_where;
        }
    }
    
    logging(__FILE__, __LINE__, $sql);
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result != null && $result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
        
    return null;
}


/** 
 * get_products
 * Get products list with $category and $brand
 * $category contain categoryId
 * $$brand contain brandId
 * @param $category, $brand
 * 
 */
function get_products($categoryarr, $brandarr){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    $sql = "SELECT * from products ";
    if (count($categoryarr) > 0 || count($brandarr) >0){
        $category_where = "";
        foreach($categoryarr as $category){
            if ($category == "")   continue;
            logging(__FILE__, __LINE__, $category);
            if($category_where != "")
                $category_where .= " OR ";
            
            $category_where .= "categoryId = '" . $category . "'";
        }
        
        $brand_where = "";
        foreach($brandarr as $brand){
            if ($brand == "")   continue;
            
            logging(__FILE__ . ":" . __LINE__ . $brand);
            if($brand_where != "")
                $brand_where .= " OR ";
            
            $brand_where .= "brandId = '" . $brand . "'";
        }
        
        logging(__FILE__, __LINE__, $category_where);        
        logging(__FILE__, __LINE__, $brand_where);
        //if ($category_where != "" and $brand_where != "")
        if (strpos($category_where, 'category') !== false && strpos($brand_where, 'brand') !== false) {
            logging(__FILE__, __LINE__, $category_where . ", " . $brand_where); 
            $sql .= "WHERE (" . $category_where . ") AND (" . $brand_where . ")";
        //else if ($category_where != ""){
        }else if(strpos($category_where, 'category') !== false){
            logging(__FILE__, __LINE__, $category_where); 
            $sql .= "WHERE " . $category_where;
        }else if(strpos($brand_where, 'brand') !== false){
            logging(__FILE__, __LINE__, $brand_where); 
            $sql .= "WHERE " . $brand_where;
        }
    }
    
    logging(__FILE__, __LINE__, $sql);
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result != null && $result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
        
    return null;
}


/** 
 * get_products_withlimit
 * Get number of $count of products list with $category 
 * $category contain categoryId
 * $count how many products
 * @param $category, $count
 * 
 */
function get_products_withlimit($categoryarr, $count){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    $sql = "SELECT * from products ";
    if (count($categoryarr) > 0 || count($brandarr) >0){
        $category_where = "";
        foreach($categoryarr as $category){
            if ($category == "")   continue;
            logging(__FILE__, __LINE__, $category);
            if($category_where != "")
                $category_where .= " OR ";
            
            $category_where .= "categoryId = '" . $category . "'";
        }
        
        if(strpos($category_where, 'category') !== false){
            logging(__FILE__, __LINE__, $category_where); 
            $sql .= "WHERE " . $category_where;
        }
    }
    $sql .= " LIMIT " . $count;
    
    logging(__FILE__, __LINE__, $sql);
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result != null && $result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
        
    return null;
}


/** 
 * get_products_with_searchkey
 * Get products list with search keys
 * $keyarr contain searching keys
 * @param $keyarr
 * 
 */
function get_products_with_searchkey($keyarr){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    $sql = "SELECT * from products ";
    if (count($keyarr) > 0){
        $where_stmt = "";
        foreach($keyarr as $key){
            if ($key == "")   continue;
            
            if($where_stmt != "")
                $where_stmt .= " OR ";
            
            $where_stmt .= "category like '%" . $key . "%' OR ";
            $where_stmt .= "name like '%" . $key . "%' OR ";
            $where_stmt .= "description1 like '%" . $key . "%' OR ";
            $where_stmt .= "description2 like '%" . $key . "%'";
        }
      
        logging(__FILE__, __LINE__, $where_stmt);
        //if ($category_where != "" and $brand_where != "")
        if (strpos($where_stmt, 'category') !== false) {
            $sql .= "WHERE " . $where_stmt;
        }
    }
    
    logging(__FILE__, __LINE__, $sql);
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result != null && $result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
        
    return null;
}


/** 
 * get_products
 * Get products list with $category and $brand
 * $category contain categoryId
 * $$brand contain brandId
 * @param $category, $brand
 * 
 */
function get_product_detail($pids){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    if (!is_array($pids) && $pid == "") return null;
    
    $sql = "SELECT * from products ";
    $where = "";
    foreach($pids as $pid){
        if ($pid != "")
            if ($where != "")
                $where .= " OR ";
            $where .= "pId='" . $pid . "'";
    }
    
    if($where != ""){
        $sql .= "WHERE " . $where;
    }
    
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result != null && $result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
    
    
    return null;
}

function user_login($username, $password)
{
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    $sql = "SELECT * FROM users WHERE email='$username' and password='$password'";
    
    $result = $conn->query($sql);
    $count = mysqli_num_rows($result);
    disconnect_db($conn);
    logging(__FILE__, __LINE__, $sql . "Result : [" . $count . "]");

    return $count;
}