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
* utility functions
*/





/*
* ## argument: opencart customer id
* ## return: user information array from bb db or false
* this function will:
* # check the provided id in opencart database
* # if success, then it will search in phpbb database by email from opencart as username in phpbb
* # if found, then return the user row
* # if not found, then it will create a phpbb user with appropriate permissions(opencart customer==general forum user, opencart admin==forum admin)
* # then return the new created user info from phpb database
*/
function get_oc_customer($customer_id) { //as the name says
    if ( !$customer_id ) {
        return false;
    }
    
    global $db, $sql_db, $dbhost, $dbport;

    //fetch user info from opencart database
    $sql_c = "SELECT * FROM oc_customer WHERE customer_id='" . (int)$customer_id."'";
    $result_c = $db->sql_query($sql_c);
    $row_c = $db->sql_fetchrow($result_c);
    $db->sql_freeresult($result_c);
    
    if ( count($row_c) && $row_c['email'] ) { //this is a customer
        //now we are generating username from email
        $username = $row_c['email'];
        $password = $username;
        $isadmin = false;

        $oc_user_row = $row_c;
    } else {
        return false;
    }
    
    //fetch user info from phpbb database
    $sql = 'SELECT *
    FROM ' . USERS_TABLE . "
    WHERE username_clean = '" . $db->sql_escape(utf8_clean_string($username)) . "'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    if ( $row ) { //user exists in phpbb database too
        return $row;
    } else {
        //no such user in phpbb, create the user
        if (!function_exists('user_add'))
        {
            global $phpbb_root_path, $phpEx;

            include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
        }

        // create the user if he does not exist yet
        user_add(user_row_opencart($username, $password, $oc_user_row, $isadmin));

        $sql = 'SELECT *
            FROM ' . USERS_TABLE . "
            WHERE username_clean = '" . $db->sql_escape(utf8_clean_string($username)) . "'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);

        if ($row)
        {
            return $row;
        }
    }
}


/*
* ## argument: opencart user id(opencart admin)
* ## return: user information array from bb db or false
* this function will:
* # check the provided id in opencart database
* # if success, then it will search in phpbb database by username from opencart as username in phpbb
* # if found, then return the user row
* # if not found, then it will create a phpbb user with appropriate permissions(opencart customer==general forum user, opencart admin==forum admin)
* # then return the new created user info from phpb database
*/
function get_oc_user($user_id) {
    if ( !$user_id ) {
        return false;
    }
    
    global $db, $sql_db, $dbhost, $dbport;

    //fetch user info from opencart database
    $sql_u = "SELECT * FROM oc_user WHERE user_id='" . (int)$user_id."'";
    $result_u = $db->sql_query($sql_u);
    $row_u = $db->sql_fetchrow($result_u);
    $db->sql_freeresult($result_u);
    
    if ( count($row_u) && $row_u['email'] && $row_u['username'] ) { //this is a customer
        //now we are generating username from email
        $username = $row_u['username'];
        $password = $row_u['email'];
        $isadmin = true;

        $oc_user_row = $row_u;
    } else {
        return false;
    }
    
    //fetch user info from phpbb database
    $sql = 'SELECT *
    FROM ' . USERS_TABLE . "
    WHERE username_clean = '" . $db->sql_escape(utf8_clean_string($username)) . "'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    
    if ( $row ) { //user exists in phpbb database too
        return $row;
    } else {
        //no such user in phpbb, create the user
        if (!function_exists('user_add'))
        {
            global $phpbb_root_path, $phpEx;

            include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
        }

        // create the user if he does not exist yet
        user_add(user_row_opencart($username, $password, $oc_user_row, $isadmin));

        $sql = 'SELECT *
            FROM ' . USERS_TABLE . "
            WHERE username_clean = '" . $db->sql_escape(utf8_clean_string($username)) . "'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);

        if ($row)
        {
            return $row;
        }
    }
}


/**
* This function generates an array which can be passed to the user_add function in order to create a user(admin or general)
*/
function user_row_opencart($username, $password, $oc_user_row, $isadmin=false)
{
    global $db, $config, $user;
    // first retrieve default group id
    if ( $isadmin ) {
        $user_type = USER_FOUNDER;
        $sql = 'SELECT group_id
        FROM ' . GROUPS_TABLE . "
        WHERE group_name = '" . $db->sql_escape('ADMINISTRATORS') . "'
            AND group_type = " . GROUP_SPECIAL;
    } else {
        $user_type = USER_NORMAL;
        $sql = 'SELECT group_id
            FROM ' . GROUPS_TABLE . "
            WHERE group_name = '" . $db->sql_escape('REGISTERED') . "'
                AND group_type = " . GROUP_SPECIAL;
    }
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    if (!$row)
    {
        trigger_error('NO_GROUP');
    }

    // generate user account data
    return array(
        'username'      => $username,
        'user_password' => phpbb_hash($password),
        'user_email'    => $oc_user_row['email'],
        'group_id'      => (int) $row['group_id'],
        'user_type'     => $user_type,
        'user_ip'       => $user->ip,
        'user_new'      => ($config['new_member_post_limit']) ? 1 : 0,
    );
}


?>