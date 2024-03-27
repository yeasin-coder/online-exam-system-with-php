<?php 
include 'inc/header.php';

  //redirect user to the login page if not logged in
  Session::checkSession();
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
$('#update_profile').click(function(){

	
    //get form fields values
    let name = $('#name').val();
    let username = $('#username').val();
    let email = $('#email').val();
   

    let data_string = "name="+name+"&username="+username+"&email="+email;

    $.ajax({
        
        url: "update_profile.php",
        method: "POST",
        data: data_string,
        success: function(data){
			
            $("#state").html(data);
			
        }
    });

    return false;
});
});
</script>

<div class="main">
<h1>Online Exam System - User Profile</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/test.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table class="tbl"> 
            <tr>
			   <td>Name</td>
			   <td><input name="name" id="name" type="text" value="<?php echo Session::get('name')?>"></td>
			 </tr>   
			 <tr>
			   <td>Username</td>
			   <td><input name="username" id="username" type="text" value="<?php echo Session::get('username')?>"></td>
			 </tr>
             <tr>
			   <td>Email</td>
			   <td><input name="email" id="email" type="text" value="<?php echo Session::get('email')?>"></td>
			 </tr>
			 
			  <tr>
			  <td></td>
			   <td><input type="submit" id="update_profile" value="Update Profile">
			   </td>
			 </tr>
       </table>
	   </form>
	   <div id="state">

	   </div>
	   <p>Want change password? <a href="change_password.php">Change</a> Here</p>
	</div>


	
</div>
<?php include 'inc/footer.php'; ?>