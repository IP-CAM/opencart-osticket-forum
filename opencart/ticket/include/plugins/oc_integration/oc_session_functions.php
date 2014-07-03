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


function check_oc_session() {
    global $oc_customer;
    $error;
    
    if ( !$oc_customer['customer_id'] ) { //not in global variable, SESSION desabled for hunt_easter
        $customer = get_oc_customer_from_db();
        if ( count($customer) && $customer['customer_id'] ) {
            //setting global variable and SESSION
            $oc_customer = $customer;
            //set_oc_customer_session($customer);
            
            return $oc_customer;
        } else {
            return false;
        }
    } else {
        return $oc_customer;
    }
}

function get_oc_customer_session() {
    /* currently session check is desabled
    if ( $_SESSION['oc_customer']['customer_id'] ) {
        return $_SESSION['oc_customer'];
    } else {
        return false;
    }
    */
    return false;
}

//sets the SESSION data
function set_oc_customer_session($oc_customer) {
    $_SESSION['oc_customer'] = $oc_customer;
}

function unset_oc_customer_session() {
    unset($_GLOBALS['oc_session']);
}

//looks opencart session table and try to fetch logged customer info and return an array, if no customer found, returns empty array
function get_oc_customer_from_db() {
    $customer = array();
    $customer['user_type'] = '';
    $customer['session_id_hash'] = '';
    $customer['logged'] = '';
    $customer['data'] = array();
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $sql = 'SELECT * FROM oc_session WHERE iscustomer=' . db_input(1) . ' AND ip=' . db_input($ip) . ' AND logged_date>NOW()-INTERVAL 1 DAY ORDER BY logged_date DESC LIMIT 1';
    if ( ($res = db_query($sql)) && db_num_rows($res) ) {
        $row = db_fetch_array($res);
        $user_id = $row['customer_id'];
        $email = $row['email'];
        $session_id_hash = $row['session_id_hash'];
    } else { //no data in session table
        $user_id = 0;
        $email = '';
        $session_id_hash = '';
    }
    $customer['session_id_hash'] = $session_id_hash;
    
    /*
    $sql = 'SELECT * FROM oc_session WHERE ip=' . db_input($ip) . ' AND session_id_hash=' . db_input($token) . ' ORDER BY logged_date DESC LIMIT 1';
    */
    if ( $user_id && $email ) { //user found in session table
        $customer['logged'] = true;
        
        $sql_c = 'SELECT * FROM oc_customer WHERE customer_id=' . db_input($user_id) . ' AND email=' . db_input($email);
        
        if ( ($res_c = db_query($sql_c)) && db_num_rows($res_c) ) { //opencart customer
            $customer['data'] = db_fetch_array($res_c);
            $customer['user_type'] = 'customer';
        }
    } else { // no user in session table
        $customer['logged'] = false;
    }
    
    return $customer;
}

function CurlConnect($url, $request='') {
    $length=strlen($request);
    $ch = curl_init($url);
    $options = array(
            CURLOPT_RETURNTRANSFER => true,         // return web page
            CURLOPT_HEADER         => false,        // don't return headers
            CURLOPT_FOLLOWLOCATION => false,         // follow redirects
            CURLOPT_ENCODING       => "utf-8",           // handle all encodings
            CURLOPT_AUTOREFERER    => true,         // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 20,          // timeout on connect
            CURLOPT_TIMEOUT        => 20,          // timeout on response
            CURLOPT_POST            => 0,            // i am sending post data
            //CURLOPT_POSTFIELDS     => $request,    // this are my post vars
            CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
            CURLOPT_SSL_VERIFYPEER => false,        //
            CURLOPT_VERBOSE        => 1
            
    ); 
    curl_setopt_array($ch,$options);
    $data = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    //echo $curl_errno;
    //echo $curl_error;
    curl_close($ch);
    return $data;
}

?>