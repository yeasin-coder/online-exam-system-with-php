<?php 
    
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/classes/User.php');

    //create a new object of the User class
    $usr = new User();
   
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $username = $_POST["username"];

        $registration = $usr->user_registration($name, $username, $email, $password);
        

    }

?>