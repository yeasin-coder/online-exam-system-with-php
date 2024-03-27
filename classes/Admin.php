<?php 


    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');

class Admin{

    //some private property
    private $db;
    private $fm;
    //constructor function
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    //create admin login mechanism
    public function admin_login($data){
        //catch the value form the form field
        $username = $data['username'];
        $password = $data['password'];

        
        //validation form field value
        $username = $this->fm->validation($username);
        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = md5($password);

        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password' ";

        $result = $this->db->select($sql);

        if($result){
            $value = $result->fetch_assoc();
            //set session here for admin logged in user
            //start the session
            Session::init();
            Session::set("admin_login", true);
            Session::set("admin_id", $value["id"]);
            Session::set("admin_user", $value["username"]);

            //redirect to index.php file  if successfull login
            header("Location: index.php");
        }else{
            $msg = "<p class='error'>Username or Password is incorrect!</p>";
            return $msg;
        }
       
    }
}

?>