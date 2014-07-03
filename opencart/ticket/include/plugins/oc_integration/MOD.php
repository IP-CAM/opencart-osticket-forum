<?php

/*
* integration pack 2.0
* 
* ## Copyright (c) <2014> <minhaj: polarglow06@gmail.com, minhaj@vimmaniac.com>
* ## https://github.com/minhaj-vimmaniac
* ## http://vimmaniac.com/
* ## under the MIT license
*
*
*
* 
*/

//check opencart customer logged in or not
require_once(INCLUDE_DIR.'plugins/oc_integration/class.oc_customer.php');

$oc_customer = array();

if ( isset($_SESSION['customer_id']) && ($oc_customer_id = $_SESSION['customer_id']) ) {
    $customer = new Oc_customer($oc_customer_id);
} else { //no customer logged, redirect to opencart customer login page
    require_once(INCLUDE_DIR.'plugins/oc_integration/no_access.php');
    exit;
}

?>