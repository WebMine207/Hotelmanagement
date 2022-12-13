$(document).ready(function () {
     $(".loginForm").parsley();
     $(".RegisterForm").parsley();
     $(".ForgotPasswordForm").parsley();
     
     window.Parsley.addValidator('special', {
          requirementType: 'number',
          validateString: function(value, requirement) {
               var specials = value.match(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/g) || [];
               return specials.length >= requirement;
          },  
     });
});
function myPassFunction() {
     var x = document.getElementById("password");
     if (x.type === "password") {
     x.type = "text";
     } else {
     x.type = "password";
     }
 }
 function myFunction(id="") {
     var x = document.getElementById(id);
     if (x.type === "password") {
     x.type = "text";
     } else {
     x.type = "password";
     }
 }