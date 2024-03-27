<?php 
include 'inc/header.php';
  //redirect logged user to the exam.php page
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
<h1>Online Exam System - Final Result</h1>

<div class="main-content">
    <h2>Welcome You Are Done!</h2>
    <h3>Score: <?php
    if(isset($_SESSION['score'])){
        echo $_SESSION['score'];
    }
     ?></h3>
</div>
	
</div>
<?php include 'inc/footer.php'; ?>