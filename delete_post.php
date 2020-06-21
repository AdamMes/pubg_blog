<?php

require_once 'app/helpers.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: blog.php');
    exit;
}

if (isset($_GET['pid']) && is_numeric($_GET['pid'])) {


    $uid = $_SESSION['user_id'];
    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
    $pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING);
    $pid = mysqli_real_escape_string($link, $pid);

    if ($pid) {

        $sql = "DELETE FROM posts WHERE id = $pid AND user_id = $uid";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_affected_rows($link) > 0) {

            header('location: blog.php');
            exit;
        }
    }
}

header('location: blog.php');