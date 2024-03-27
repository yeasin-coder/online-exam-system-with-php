<?php 

    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/classes/User.php');

    $usr = new User();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login = $usr->user_login($username, $password);
    }

?>