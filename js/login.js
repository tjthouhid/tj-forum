jQuery(function($){
  

$( "#login" ).validate({
  rules: {
     
      user_name: "required",
      user_password: "required"
      
      
         
	},
  messages: {
   
    user_name: "Username Required!",
    user_password: "Password Required!"
    

  }
  
});

});