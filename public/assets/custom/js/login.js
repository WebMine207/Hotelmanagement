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