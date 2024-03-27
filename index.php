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
$('#user_login').click(function(){

	
    //get form fields values
    let username = $('#username').val();
    let password = $('#password').val();

    let data_string = "username="+username+"&password="+password;

    $.ajax({
        
        url: "get_loggedin.php",
        method: "POST",
        data: data_string,
        success: function(data){
			if(data == 'success'){
				window.location = "exam.php";
			}else{
            	$("#state").html(data);
			}
        }
    });

    return false;
});
});
</script>

<div class="main">
<h1>Online Exam System - User Login</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/test.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table class="tbl">    
			 <tr>
			   <td>Username</td>
			   <td><input name="username" id="username" type="text"></td>
			 </tr>
			 <tr>
			   <td>Password </td>
			   <td><input name="password" id="password" type="password"></td>
			 </tr>
			 
			  <tr>
			  <td></td>
			   <td><input type="submit" name="login" id="user_login" value="Login">
			   </td>
			 </tr>
       </table>
	   </form>
	   <div id="state">

	   </div>
	   <p>New User ? <a href="register.php">Signup</a> Free</p>
	</div>


	
</div>
<?php include 'inc/footer.php'; ?>