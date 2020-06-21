<?php

require_once 'db_config.php';


if (!function_exists('old')) {

    /**
     *
     * Restore last value to a field
     *
     * @param    string  $fn The field name
     * @return   string
     *
     */
    function old($fn)
    {
        return $_REQUEST[$fn] ?? '';
    }
}


if (!function_exists('csrf')) {

    /**
     *
     * Generate random string for security
     *
     * @return   string
     *
     */
    function csrf()
    {

        $token = sha1(rand(1, 10000) . '$$' . rand(1, 1000) . 'pubg');
        $_SESSION['csrf_token'] = $token;
        return $token;
    }
}


if (!function_exists('user_auth')) {
    /**
     *
     * Authoriziton for login user - session hijacking
     *
     * @return   boolean
     *
     */
    function user_auth()
    {
        $auth = false;
        if (isset($_SESSION['user_id'])) {
            if (isset($_SESSION['user_ip']) && $_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR']) {

                if (isset($_SESSION['user_agnet']) && $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT']) {
                    $auth = true;
                }
            }
        }
        return $auth;
    }
}

if (!function_exists('email_exist')) {
    /**
     *
     * Checking if haveing this value already in the DB 
     *
     * @param    string  $link Connect to MYSQL DB
     * @param    string  $email The email that user type
     * @return   boolean
     *
     */
    function email_exist($link, $email)
    {
        $exist = false;
        $sql = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $exist = true;
        }

        return $exist;
    }
}

if (!function_exists('get_email_name')) {
    /**
     *
     * Getting the value from filed in DB 
     *
     * @param    string  $link Connect to MYSQL DB
     * @param    string  $email The email that user type
     * @return   string
     *
     */

    function get_email_name($link, $email)
    {
        $user_email = '';
        $sql = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($link, $sql);
        $u_email = mysqli_fetch_assoc($result);
        $user_email = $u_email['email'];
        return $user_email;
    }
}