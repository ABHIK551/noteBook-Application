$(function(){
    //Ajax call to update updateUsername.php
           //Once the form is subbmited
    $("#updateUsername").submit(function(event){
         //Prevent default php prcessing
        event.preventDefault();
        //Collect the user input
        var datatopost = $(this).serializeArray();
        
      // Send them to signup.php using AJAX
    $.ajax({
        url:"updateUsername.php",
        type:"POST",
        data:datatopost,
        success:function(data){
       $("#errorMessage").html(data);
            if(data){
                 //AJAX call successfull: show error or success message
                $("#errorMessage").html(data);
            }else{
                location.reload();
            }
        },error:function(){
            //AJAX call fails: show AJAX calls error
            $("#errorMessage").html('<div class="alert alert-danger">There was an error while ajax call please try again later</div>');
        }
//    $.post({}).done().fail();
        });
    });
    //Ajax call to update updateEmail.php
    $("#updateemail").submit(function(event){
         //Prevent default php prcessing
        event.preventDefault();
        //Collect the user input
        var datatopost = $(this).serializeArray();
        
      // Send them to signup.php using AJAX
    $.ajax({
        url:"updateEmail.php",
        type:"POST",
        data:datatopost,
        success:function(data){
       $("#errorMessage1").html(data);
            if(data){
                 //AJAX call successfull: show error or success message
                $("#errorMessage1").html(data);
            }else{
                location.reload();
            }
        },error:function(){
            //AJAX call fails: show AJAX calls error
            $("#errorMessage1").html('<div class="alert alert-danger">There was an error while ajax call please try again later</div>');
        }
//    $.post({}).done().fail();
});
    });
    //Ajax call to update updatePassword.php
    
    $("#updatepassword").submit(function(event){
         //Prevent default php prcessing
        event.preventDefault();
        //Collect the user input
        var datatopost = $(this).serializeArray();
        
      // Send them to signup.php using AJAX
    $.ajax({
        url:"updatePassword.php",
        type:"POST",
        data:datatopost,
        success:function(data){
       $("#errorMessage2").html(data);
            if(data){
                 //AJAX call successfull: show error or success message
                $("#errorMessage2").html(data);
            }else{
                location.reload();
            }
        },error:function(){
            //AJAX call fails: show AJAX calls error
            $("#errorMessage2").html('<div class="alert alert-danger">There was an error while ajax call please try again later</div>');
        }
//    $.post({}).done().fail();
        });
    });
});