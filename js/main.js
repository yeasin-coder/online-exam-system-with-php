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
            }
        });
    
        return false;
    });

   
    });