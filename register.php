<?php 
  include 'inc/header.php'; 

  //redirect logged user to the exam.php page
  Session::checkLogin();
?>

<style>
  .success, .error{
  color: white;
  margin: 10px 0;
  padding: 5px 10px;
  background: green;
  border-radius: 4px;
  display:block;
}

.error{
  background: red;
}
</style>

<script>
  $(function(){

//user registration system
$('#user_register').click(function(){

 
    //get form fields values
    let name = $('#name').val();
    let username = $('#username').val();
    let email = $('#email').val();
    let password = $('#password').val();

    let data_string = "name="+name+"&username="+username+"&email="+email+"&password="+password;

    $.ajax({
        
        url: "get_registered.php",
        method: "POST",
        data: data_string,
        success: function(data){

          $("#state").html(data);

          setTimeout(function(){
             $("#state").html(data).fadeOut();
          }, 3000);
            
        }
    });

    return false;
});
});
</script>

<div class="main">
<h1>Online Exam System - User Registration</h1>


	<div class="segment" style="margin-right:30px;">
		<img src="img/regi.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table>
		<tr>
           <td>Name</td>
           <td><input type="text" name="name" id="name"></td>
         </tr>
		<tr>
           <td>Username</td>
           <td><input name="username" type="text" id="username"></td>
         </tr>

         <tr>
           <td>E-mail</td>
           <td><input name="email" id="email" type="text"></td>
         </tr>

         <tr>
           <td>Password</td>
           <td><input type="password" id="password" name="password"></td>
         </tr>
         
        
         <tr>
           <td></td>
           <td><input type="submit" id="user_register" value="Create Account">
           </td>
         </tr>
       </table>
	   </form>
     <div id="state"></div>
	   <p>Already Registered ? <a href="index.php">Login</a> Here</p>
	</div>


	
</div>
<?php include 'inc/footer.php'; ?>