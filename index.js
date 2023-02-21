//Ajax calls for signup form
$(function(){
    //Once the form is subbmited
    $("#signupForm").submit(function(event){
         //Prevent default php prcessing
        event.preventDefault();
        //Collect the user input
        var datatopost = $(this).serializeArray();
        
      // Send them to signup.php using AJAX
    $.ajax({
        url:"signup.php",
        type:"POST",
        data:datatopost,
        success:function(data){
       $("#signUpMessage").html(data);
            if(data){
                 //AJAX call successfull: show error or success message
                $("#signUpMessage").html(data);
            }
        },error:function(){
            //AJAX call fails: show AJAX calls error
            $("#signUpMessage").html('<div class="alert alert-danger">There was an error while ajax call please try again later</div>');
        }
//    $.post({}).done().fail();
});
    });
    //Ajax calls for login form
$("#logingForm").submit(function(event){
         //Prevent default php prcessing
        event.preventDefault();
        //Collect the user input
        var datatopost = $(this).serializeArray();
    
      // Send them to login.php using AJAX
    $.ajax({
        url:"login.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            $("#loginMessage").html(data);
            if(data = "success"){
                window.location = "mainfile.php";
            }else{
                $("#loginMessage").html(data);
            }
        },error:function(){
            $('#loginMessage').html('<div class="alert alert-danger">There was an error while ajax call please try again later</div>');
        }
//    $.post({}).done().fail();
});
    });
    
    //Once the form is subbmited
    $("#forgotPass").submit(function(event){
         //Prevent default php prcessing
        event.preventDefault();
        //Collect the user input
        var datatopost = $(this).serializeArray();
    
      // Send them to login.php using AJAX
    $.ajax({
        url:"forgotpassword.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            $("#forgotpassMessage").html(data);
            if(data){
               $("#forgotpassMessage").html(data);
            }
        },error:function(){
            $("#forgotpassMessage").html('<div class="alert alert-danger">There was an error while ajax call please try again later</div>');
        }
//    $.post({}).done().fail();
});
});
});