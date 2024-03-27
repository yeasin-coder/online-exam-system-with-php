<?php 


    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
    include_once ($filepath.'/../lib/Session.php');

class User{

    //some private property
    private $db;
    private $fm;
    //constructor function
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    //create admin login mechanism
    public function user_login($username, $password){
       
        if($username == "" || $password == ""){
            echo "<span class='error'>Fields must not be empty</span>";
            exit();
        }else{
            //validation form field value
            $username = $this->fm->validation($username);
            $password = $this->fm->validation($password);
            $password = md5($password);

            $sql = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password' ";

            $result = $this->db->select($sql);

            if($result){
                $value = $result->fetch_assoc();
                if($value['status'] == '1'){
                    echo "<p class='error'>Your profile is disabled by admin!</p>";
                    exit();
                }else{
                    //set Session for logged in user
                    Session::init();
                    Session::set("login", true);
                    Session::set('user_id', $value['id']);
                    Session::set('name', $value['name']);
                    Session::set('username', $value['username']);
                    Session::set('email', $value['email']);

                    echo "success";
                    exit();
                }
            }else{
                echo "<p class='error'>Username or Password is incorrect!</p>";
                exit();
            }

    }
       
    }


    //get all registered users
    public function get_all_user(){
        $sql = "SELECT * FROM tbl_user";
        $result = $this->db->select($sql);
        if($result){
            return $result;
        }

    }

    //disable user mechanism
        public function disable_user_by_id($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $id = (int)$id;
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $sql = "UPDATE tbl_user SET status = 1 WHERE id = '$id'";

            $result = $this->db->update($sql);

            if($result){
                $msg = "<span class='success'>Success! User Disabled.</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Error! User Not Disabled.</span>";
                return $msg;
            }
        }


        //enable user mechanism
        public function enable_user_by_id($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $id = (int)$id;
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $sql = "UPDATE tbl_user SET status = 0 WHERE id = '$id'";

            $result = $this->db->update($sql);

            if($result){
                $msg = "<span class='success'>Success! User Enabled.</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Error! User Not Enabled.</span>";
                return $msg;
            }
        }


        //delete user mechanism
        public function delete_user_by_id($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $id = (int)$id;
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $sql = "DELETE FROM tbl_user WHERE id = '$id'";

            $result = $this->db->delete($sql);
            if($result){
                return true;
            }
        }


        //user registration mechanism
        public function user_registration($name, $username, $email, $password){


            //form validation
            if($username == "" || $email == "" || $name == "" || $password == ""){
                echo "<span class='error'>Fields must not be empty</span>";
                exit();
            }else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                echo "<span class='error'>Email Address is not Valid!</span>";
                exit();
            }else if($this->fm->check_username($username)){
                echo "<span class='error'>Username already exist! Please try a new one</span>";
                exit();
            }else if($this->fm->check_email($email)){
                echo "<span class='error'>Email Address already exist! Please Login</span>";
                exit();
            }else{

                //validate all fields value

                $name = $this->fm->validation($name);
                $email = $this->fm->validation($email);
                $password = $this->fm->validation($password);
                $username = $this->fm->validation($username);

                //encrypt the password with md5 hash
                $password = md5($password);

                $sql = "INSERT INTO tbl_user(name, username, email, password) VALUES('$name', '$username', '$email', '$password')";

                $result = $this->db->insert($sql);

                if($result){
                    echo "<span class='success'>Welcome ". $name . "! You registered successfully.</span>";
                    exit();
                }else{
                    echo "<span class='error'>Something went wrong, please try again</span>";
                    exit();
                }
            }


            

        }


        //update user profile mechanism
        public function update_user_profile($name, $username, $email, $id, $old_username, $old_email){

            //validate all fields value

            $name = $this->fm->validation($name);
            $email = $this->fm->validation($email);
      
            $username = $this->fm->validation($username);
            $id = $this->fm->validation($id);


            //form validation
            if($username == "" || $email == "" || $name == ""){
                echo "<span class='error'>Fields must not be empty</span>";
                exit();
            }else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                echo "<span class='error'>Email Address is not Valid!</span>";
                exit();
            }else{

                //  if($this->fm->check_username($username)){
                //     echo "<span class='error'>Username already exist! Please try a new one</span>";
                //     exit();
                // }else if($this->fm->check_email($email)){
                //     echo "<span class='error'>Email Address already exist!</span>";
                //     exit();
                // }

                if($username != $old_username){
                    if($this->fm->check_username($username)){
                        echo "<span class='error'>Username already exist! Please try a new one</span>";
                        exit();
                    }
                }else if($email != $old_email){
                    if($this->fm->check_email($email)){
                        echo "<span class='error'>Email Address already exist!</span>";
                        exit();
                    }
                }


            
                $sql = "UPDATE tbl_user SET name = '$name', username = '$username', email = '$email' WHERE id = '$id' ";

                $result = $this->db->update($sql);

                if($result){
                     //set Session for logged in user
                    
                     Session::set("login", true);
                     Session::set('user_id', $id);
                     Session::set('name', $name);
                     Session::set('username', $username);
                     Session::set('email', $email);

                    echo "<span class='success'>User profile updated successfully</span>";
                    exit();
                }else{
                    echo "<span class='error'>User profile not updated</span>";
                    exit();
                }
            }
        }


        //get user by id
        public function get_user_by_id($id){
            $sql = "SELECT * FROM tbl_user WHERE id = '$id'";
            $result = $this->db->select($sql);
            if($result){
                return $result;
            }else{
                return false;
            }
        }
        
}

?>