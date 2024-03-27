<?php 
//include the User class
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/classes/User.php');
include_once ('lib/Session.php');
Session::init();

//create a new object of the User class
$usr = new User();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = Session::get('id');
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];

        $old_username = Session::get('username');
        $old_email = Session::get('email');
        $update = $usr->update_user_profile($name, $username, $email, $id, $old_username, $old_email);
    }

?>