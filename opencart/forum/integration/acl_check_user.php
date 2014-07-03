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
* checks login(session info) from opencart and takes required actions
*/


if ( !defined('ADMIN_START') ) {//not applicable for admin logins
    if ( isset($_SESSION['customer_id']) && $_SESSION['customer_id'] ) { //opencart customer logged in
        if ( $userdata['user_id'] == ANONYMOUS ) { //not yet logged in forum
            if ( $u_data = get_oc_customer($_SESSION['customer_id']) ) {
                $userdata = $u_data;
                $user->session_create($u_data['user_id']);
            }
        }
    } elseif ( isset($_SESSION['user_id']) && $_SESSION['user_id'] ) { //opencart admin logged in
        if ( $userdata['user_id'] == ANONYMOUS ) { //not yet logged in forum
            if ( $u_data = get_oc_user($_SESSION['user_id']) ) {
                $userdata = $u_data;
                $user->session_create($u_data['user_id']);
            }
        }
    } elseif ( ( $userdata['user_id'] != ANONYMOUS ) ) {
        $user->session_kill();
    }
} else {//in forum admin section
    if ( isset($_SESSION['user_id']) && $_SESSION['user_id'] ) { //opencart admin logged in
        if ( $userdata['user_id'] == ANONYMOUS ) { //not yet logged in forum
            if ( $u_data = get_oc_user($_SESSION['user_id']) ) {
                $userdata = $u_data;
                $user->session_create($u_data['user_id']);
            }
        }
    }
    /* now the difference is: sessions will not be killed auto
     else {
        $user->session_kill();
    }
    */
}
?>