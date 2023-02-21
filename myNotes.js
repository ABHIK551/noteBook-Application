$(function(){
    //define variables
    var activeNote = 0;
    var editMode = false;
    //load notes on page load: Ajax call to loadnotes.php
   
        $.ajax({
        url:"loadnotes.php",
        success: function (data){
            $("#notes").html(data);
            clickOnNote();
            clickOnDelete();
        }
    });
    
    //add a new note: Ajax call to createnotes.php
    
    $("#addNote").click(function(){
        $.ajax({
        url:"createnotes.php",
        success: function (data){
            if(data == "error"){
                $("#alertConent").text("failed to insert data in database");
                $("#alert").fadeIn()
               }else{
                   //update activenote to the id of the new note
                    activeNote = data;
                   $("textarea").val("");
                   showHide(['#notepad','#allNotes'],['#notes','#addNote','#edit',"#done"]);
                   $("textarea").focus();
               }
        },error:function(){
            $("#alertConent").html('There was an error while ajax call please try again later');
             $("#alert").fadeIn()
        }
    });
    });
    //type notes : Ajax call to updatenotes.php
    $("textarea").keyup(function(){
        //Ajax call to update the task of id activenote
         $.ajax({
        url:"updatenotes.php",
        type:"POST",
             //we need to send current note content with its id to the php file
        data:{notes:$(this).val(), id:activeNote},
        success: function (data){
            if(data == "error"){
                $("#alertConent").text("failed to insert data in database");
                $("#alert").fadeIn()
               }
        },error:function(){
            $("#alertConent").html('There was an error while ajax call please try again later');
             $("#alert").fadeIn()
        }
    });
    });
        //click on all notes button
         $("#allNotes").click(function(){
            $.ajax({
            url:"loadnotes.php",
            success: function (data){
                $("#notes").html(data);
                showHide(['#addNote','#edit','#notes'],['#allNotes','#notepad',"#done"]);
                clickOnNote();
                clickOnDelete()
                }
            });
           });
        //click on done button after editing:load notes again
    
        $("#done").click(function(){
            editMode = false;
            $(".noteheader").removeClass("col-8 col-sm-8 col-md-8");
            $(".noteheader").css("float","none");
           showHide(['#addNote','#edit','#notes'],['#allNotes',"#done",".delete"]);
        })
        //click on edit: go to edit mode(show delete button,....)
    $("#edit").click(function(){
        //switch to edit mode
        editMode = true;
        //reduce the width of notes
        $(".noteheader").addClass("col-8 col-sm-8 col-md-8");
        $(".noteheader").css("float","left");
        showHide(['#notes','#allNotes',"#done",".delete"],['#edit',"#addNote"]);
    });
    
    //functions
        //click on delete
        function clickOnDelete(){
        $(".delete").click(function(){
            var deleteButton = $(this);
            $.ajax({
            url:"deletenotes.php",
            type:"POST",
                 //we need to send current note content with its id to the php file
            data:{id:deleteButton.next().attr("id")},
            success: function (data){
                if(data == "error"){
                    $("#alertConent").text("issue deleting the data from the data base");
                    $("#alert").fadeIn()
                   }else{
                       //remove the containing div
                       deleteButton.parent().remove();
                   }
            },error:function(){
                $("#alertConent").html('There was an error while ajax call please try again later');
                 $("#alert").fadeIn()
            }
        });
            })
        }
    
        //click on a note
        function clickOnNote(){
            $(".noteheader").click(function(){
            if(!editMode){
                //update activeNote
                activeNote = $(this).attr("id");
                
                //fill text area 
                $("textarea").val($(this).find(".text").text());
                showHide(['#notepad','#allNotes'],['#notes','#addNote','#edit',"#done"]);
                $("textarea").focus();
            }
        });
        }
        //click on delete notes
    
        //show hide function
        function showHide(array1, array2){
            for(i=0; i<array1.length; i++){
                $(array1[i]).show();
            }
            for(i=0; i<array2.length; i++){
                $(array2[i]).hide();
            }
        };
});