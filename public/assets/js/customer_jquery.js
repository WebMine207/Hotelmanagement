$.validator.addMethod('checkemail', function (value) {
    return /^([\w-\.]+@([\w-]+\.)+[a-z]{2,10})?$/.test(value);
}, 'Please enter a valid email');

$.validator.addMethod("noSpace", function(value, element) {
    if($.trim(value) == 0) {
        return false;
    }
    return true;
}, "Space are not allowed");

$.validator.addMethod("mobile_number", function (value, element) {
    return this.optional(element) ||
        value.match(/^[0-9,\-]+$/);
}, "Please enter a valid number");

$.validator.addMethod("input_mask_mobile_number", function (value, element) {
    return /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/is.test(value);

}, "Please enter a valid number");

$.validator.addMethod("pwcheck", function (value) {
    return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(value);
}, "The password should contain minimum 8 characters at least 1 uppercase alphabet, 1 lowercase alphabet, 1 special character, 1 numeric value.");

$.validator.addMethod("username", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9._]+$/.test(value);
},"Please enter valid username");

$.validator.addMethod("checkurl", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9._:/]+$/.test(value.trim());
},"Please enter valid url");

$.validator.addMethod("checkWebsiteUrl", function(value, element) {
    return this.optional(element) || /^((https?|ftp|smtp):\/\/)?(\www\.[a-z0-9]{5,})+(\.[a-z]{2,}){1,3}(#?\/?[a-zA-Z0-9#]+)*\/?(\?[a-zA-Z0-9-_]+=[a-zA-Z0-9-%]+&?)?$/.test(value.trim());
},"Please enter valid url");

/* Toaster JQuery */
toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 4000
};
/* END - Toaster JQuery*/

   /* mobile number field input mask */
    $(document).ready(function(){
        $('.mobile_input_mask').inputmask('(999)-999-9999');
    });

$(document).on('keyup','#filter_form input',function(e){
    if($(this).val().length > 2 || $(this).val().length == 0){
        $('#filter_page').val(0);
        $('#filter_form').trigger('submit');
    }
});

$(document).on('submit','#filter_form',function(e){
    e.preventDefault();
    var form_data = $(this).serialize();
    var form_url = $(this).attr('action');
    $.ajax({
        type: "GET",
        url: form_url,
        dataType: 'json',
        cache: false,
        data: form_data,

        success: function(data) {
            if(data.status == 200){
                $('#load_content').html(data.content);
            }else{
                toastr.error(data.message);
            }
        },
        error: function(){
            toastr.error('Something went wrong');
        }
    });
});

  /* contact now button popover */
  $('.contact_popover').popover({
    container: 'body'
  })

// read more javascript start
$('.read-more-content').addClass('hide_content')
    $('.read-more-show, .read-more-hide').removeClass('hide_content')

// Set up the toggle effect:
$('.read-more-show').on('click', function(e) {
    $(this).next('.read-more-content').removeClass('hide_content');
    $(this).addClass('hide_content');
    e.preventDefault();
});

// Changes contributed by @diego-rzg
$('.read-more-hide').on('click', function(e) {
    var p = $(this).parent('.read-more-content');
    p.addClass('hide_content');
    p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
    e.preventDefault();
});
// read more javascript End
