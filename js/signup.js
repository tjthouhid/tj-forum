jQuery(function($){
  
   var response_email;
   var response_username;

  $.validator.addMethod(
      "uniqueUserEmail", 
      function(value, element) {
          $.ajax({
              type: "POST",
              url: "functions/checkUserEmail.php",
              data: {
                checkUserEmail : value
              },
              dataType:"html",
              success: function(msg)
              {
                  //If username exists, set response to true
                  response_email = ( msg == 'true' ) ?  false : true;
                  
              }
           });
          return response_email;
      },
      "Email is Already Taken!"
  );
  $.validator.addMethod(
      "uniqueUserName", 
      function(value, element) {
          $.ajax({
              type: "POST",
              url: "functions/checkUserName.php",
              data: {
                checkUserName : value
              },
              dataType:"html",
              success: function(msg)
              {
                  //If username exists, set response to true
                  response_username = ( msg == 'true' ) ?  false : true;
                  
              }
           });
          return response_username;
      },
      "User Name is Already Taken!"
  );

$( "#signup" ).validate({
  rules: {
      user_fname: "required",
      user_lname: "required",
      
      user_name: {
        required: true,
        uniqueUserName: true
      },
      user_image: {
        required: true
      },
	    user_email: {
        required: true,
        email: true,
        uniqueUserEmail: true
      },
      user_password :{
        required: true,
        minlength: 6
      },
      user_password_con: {
           equalTo: "#user-pass"
         }

	},
  messages: {
    user_fname:"User First Name Requierd!",
    user_lname:"User Last Name Required!",
    user_name:{
      required :"Username Required!"
    },
  	user_email:{
      required : "Email Required!",
      email : "Email Required!"
    },
    user_password :{
          required: "Password Required!",
          minlength: "Password Minimum Length 6"
        }

  }
  
});

});