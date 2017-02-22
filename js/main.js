// This Function For show Notificaton
    function showNotifyJs(error_msg,type){

          $.notify(
            error_msg, 
        
            {
              position:"top right",
              autoHide: true,
              // if autoHide, hide after milliseconds
              autoHideDelay: 5000,
              className: type
            }
            

           );
    }
    function load_topics(topic_id=0){
        $.ajax({
           url: 'functions/getTopic.php',
           type: 'post',
           dataType: 'html',
           data: {
             topic_id: topic_id
           },
           success :function(data) {
            // console.log(data)
             //return false;
              if(data=="false"){
               showNotifyJs("Somthing Went Wrong! Relode The Page","error");
               return false;
              }else{
              
               $("#topic_id").html(data);
               return true;
              }
        
           
           }

         }); 

    }

    function sendFile(file, editor, welEditable) {
    
                data = new FormData();
                data.append("file", file);
                $.ajax({
                    data: data,
                    type: "POST",
                    dataType:"json",
                    url: "functions/uploadImage.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                      if(url.result==true){
                       // var added_img="uploads/images/"+url.msg;
                        var added_img="uploads/images/"+url.msg;
                        editor.summernote('insertImage', added_img);
                        //editor.insertImage(welEditable,added_img);
                      }else{
                        showNotifyJs(url.msg,"error");
                      }
                        
                        
                    }
                });
            }
jQuery(function($){

  $('#thread-textarea').summernote({
    height: 200,
    toolbar: [
      // [groupName, [list of button]]
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize']],
      ['color', ['color','picture','link']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']]
    ],
    callbacks: {
      onImageUpload: function(files, editor, welEditable) {
         
                      sendFile(files[0],  $(this), welEditable);
                  }
    }
  });
  $('.comment-thread').summernote({
    height: 200,
    toolbar: [
      // [groupName, [list of button]]
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize']],
      ['color', ['color','picture','link']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']]
    ],
    callbacks: {
      onImageUpload: function(files, editor, welEditable) {
                      
                      sendFile(files[0], $(this), welEditable);
                  }
    }
  });


  html_cc='<form action="#" class="form newtopic" method="post">'+
            '<div class="row">'+
              '<div class="col-md-12">'+
                '<div>'+
                  '<input type="text" placeholder="Enter Topic Title" class="form-control" id="topic-name" />'+
                '</div>'+
              '</div>'+
              '<div class="clearfix"></div>'+
            '</div>'+
          '</form>';
      $("body").on('click', '#add-new-topic', function(event) {

        event.preventDefault();
        var dialog = bootbox.dialog({
                 title: 'Add New Topic',
                 message: html_cc,
                 className: 'save-topic-name',
                 buttons: {
                         confirm: {
                             label: 'Save',
                             className: 'btn-success',
                             callback: function (result) {

                                    var topicName=$("#topic-name");
                                    if(topicName.val()==""){
                                     showNotifyJs("Please Insert Topic Name","error")
                                     return false;
                                    }

                                      $.ajax({
                                         url: 'functions/addTopic.php',
                                         type: 'post',
                                         dataType: 'json',
                                         data: {
                                           topicName: topicName.val()
                                         },
                                         success :function(data) {
                                           //console.log(data)
                                           //return false;
                                            if(data.result==false){
                                             showNotifyJs("Somthing Went Wrong! Try Again","error");
                                             return false;
                                            }else{
                                             showNotifyJs("Topic Added Successfully","success");
                                             load_topics(data.result)
                                            dialog.modal('hide')
                                             return true;
                                            }
                                     
                                         
                                         }

                                       }); 
                                     return false;

                                 }
                         },
                         cancel: {
                             label: 'No',
                             className: 'btn-danger',
                             callback: function (result) {
                                    // console.log('This was Not in the callback: ' + result);
                                   
                                 }
                         }
                     }
             });
      });
     $.validator.addMethod("valueNotEquals", function(value, element, arg){
      return arg != value;
     }, "Value must not equal arg.");

     $( "#new_thread" ).validate({
       rules: {          
          thread_title: "required",
          topic_id: {
            valueNotEquals : "0"
          }
           
           
              
      },
       messages: {
        
         thread_title: "Title Required!",
         topic_id: {
           valueNotEquals : "Please Select Topic!"
         }

         

       }
       
     });

     $(".delete-btn").click(function(event) {
       /* Act on the event */
       var r=confirm("Are You Sure?");
       if(r){
        return true;
       }else{
        return false;
       }
     });


     $(".delete-btn-comment").click(function(event) {
       /* Act on the event */
       var $this=$(this);
       var commentId=$this.attr('comment-id');

       var r=confirm("Are You Sure?");
       if(r){
        $.ajax({
           url: 'functions/deleteComment.php',
           type: 'post',
           dataType: 'json',
           data: {
             commentId: commentId
           },
           success :function(data) {
             //console.log(data)
             //return false;
              if(data.result==false){
               showNotifyJs("Somthing Went Wrong! Try Again","error");
               return false;
              }else{
               showNotifyJs("Comment Deleted Successfully","success");
               $(".comment-div[comment-id='"+commentId+"']").remove();
               return true;
              }
        
           
           }

        });
        
        return true;
       }else{
        return false;
       }
     });
     $(".edit-btn-comment").click(function(event) {
       /* Act on the event */
      var $this=$(this);
      var commentId=$this.attr('comment-id');
      $(".comment-div[comment-id='"+commentId+"']").find(".view-feild").hide();
      $(".comment-div[comment-id='"+commentId+"']").find(".edit-feild").show();
     });


     $(".update-comment").click(function(event) {
       /* Act on the event */
      var $this=$(this);
      var $parent=$this.closest('.comment-div');
      var commentId=$parent.attr('comment-id');
      var commentDetail=$parent.find(".edit-feild textarea").val();
      $.ajax({
         url: 'functions/updateComment.php',
         type: 'post',
         dataType: 'json',
         data: {
           commentId: commentId,
           commentDetail: commentDetail
         },
         success :function(data) {
           //console.log(data)
           //return false;
            if(data.result==false){
             showNotifyJs("Somthing Went Wrong! Try Again","error");
             $parent.find(".view-feild").show();
             $parent.find(".edit-feild").hide();
             return false;
            }else{
             showNotifyJs("Comment Updated Successfully","success");
            $parent.find(".view-feild").html(commentDetail);
            $parent.find(".view-feild").show();
            $parent.find(".edit-feild").hide();
             return true;
            }
      
         
         }

      });
      
     
      
    });

});
      
         