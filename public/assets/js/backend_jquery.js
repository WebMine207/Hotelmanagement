
$("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, 5000 ); // 5 secs
});
/* No space validation of jQuery */


 /* Toastr */
 toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var _token = $("meta[name='_token']").attr('content');

var target = document.querySelector("#load_content");
var blockUI = new KTBlockUI(target, {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Loading...</div>',
});

/* Filter Ajax*/
$(document).on('keyup','#filter_form input',function(e){
    if($(this).val().length > 2 || $(this).val().length == 0){
        $('#filter_page').val(0);
        $('#filter_form').trigger('submit');
    }
});
$(document).on('change','#filter_form select',function(){
    $('#filter_form').trigger('submit');
});

/* Status Filter */
$('#status').on('change', function (){
       var status  =$('#status').val();
       $('#form-status').val(status);
       $('#filter_form').trigger('submit');
});

$('#denomination').on('change', function (){
    var denomination  =$('#denomination').val();
    $('#form-denomination').val(denomination);
    $('#filter_form').trigger('submit');
});

$('#approval_status').on('change', function (){
    var approval_status  =$('#approval_status').val();
    $('#form-approval_status').val(approval_status);
    $('#filter_form').trigger('submit');
});

/* User type Filter */
$('#user_type').on('change', function (){
    var user_type  =$('#user_type').val();
    $('#form-user_type').val(user_type);
    $('#filter_form').trigger('submit');
});

$('#fromdate').on('change', function () {
    var fromdate= $('#fromdate').val();
    $('#todate').flatpickr({
        dateFormat: "m-d-Y",
        minDate: fromdate,
    });
});
/* Filter subscribe business */
$('#subscription_status').on('change', function (){
    var subscription_status  =0;
    if($("#subscription_status").prop('checked') == true){
        var subscription_status = 1;
    }
    // return;
    $('#form-subscription_status').val(subscription_status);
    $('#filter_form').trigger('submit');
});

/* Date filter */
$('#todate').on('change', function () {
        var fromdate= $('#fromdate').val();
        var todate  =$('#todate').val();
        $('#form-fromdate').val(fromdate);
        $('#form-todate').val(todate);
        if(todate && fromdate){
            $('#filter_form').trigger('submit');
        }
});

/* Order by query */
$(document).on('click','.orderby',function(){
    var column = $(this).attr('data-column');
    var orderby = $(this).attr('data-orderby');
    if(orderby == "asc"){
        orderby = "desc";
    }else{
        orderby = "asc";
    }
    $('#form-orderbycolumn').val(column);
    $('#form-orderby').val(orderby);
    $('#filter_form').trigger('submit');
});

/*Ajax Pagination*/
$(document).on('click','.custom-pagination a',function(e){
    e.preventDefault();
    var page_number = $(this).attr('href').split('page=')[1];
    $('#filter_page').val(page_number);
    $('#filter_form').trigger('submit');

});

$(document).on('submit','#filter_form',function(e){
    e.preventDefault();
    blockUI.block();
    var form_data = $(this).serialize();
    var form_url = $(this).attr('action');
    $.ajax({
        type: "GET",
        url: form_url,
        dataType: 'json',
        cache: false,
        data: form_data,

        success: function(data) {
            blockUI.release();
            if(data.status == 200){
                $('#load_content').html(data.content);
                KTMenu.createInstances();
                $(function () {
                    $('[data-bs-toggle="popover"]').popover()
                });
            }else{
                toastr.error(data.message);
            }
        },
        error: function(){
            blockUI.release();
            toastr.error('Something went wrong');
        }
    });
});
/* END Filter Ajax*/

/* Delete Record Jquery */
    $(document).on('click','.delete_row',function(e){
        e.preventDefault();
        var URL  = $(this).data('href');
        var title  = $(this).data('title');
        Swal.fire({
            text: "Are you sure to delete this "+title+" ?",
            icon: "warning",
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
            customClass: { confirmButton: "btn fw-bold btn-danger", cancelButton: "btn fw-bold btn-active-light-primary" },
        }).then(function (result) {
            console.log(result.isConfirmed);
            if(result.isConfirmed){
                $.ajax({
                    url:URL,
                    type: 'delete', // replaced from put
                    dataType: "JSON",
                    success: function (response)
                    {
                        location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // this line will save you tons of hours while debugging
                        Swal.fire({ text: "Something went wrong!", icon: "error", buttonsStyling: !1, confirmButtonText: "Okay", customClass: { confirmButton: "btn fw-bold btn-primary" } });
                    }
                });
            }else{

            }
        });
    });
/* END Delete Record Jquery */


/*Begin status update Ajax*/
$(document).on('change','.update_status',function(){
    var URL = $(this).attr('href');
    var title  = $(this).data('title');
    var $this = $(this);
    if($(this).is(":checked")){
        var status = 1;
        var current_status = 'active';
    }
    else if($(this).is(":not(:checked)")){
        var status = 0;
        var current_status = 'inactive';
    }

    Swal.fire({
        text: "Are you sure to "+current_status+" this "+title+" ?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel",
        customClass: { confirmButton: "btn fw-bold btn-success", cancelButton: "btn fw-bold btn-active-light-danger" },
    }).then(function (result) {
        console.log(result.isConfirmed);
        if(result.isConfirmed){
               $.ajax({
                    url: URL,
                    type: 'post',
                    data: {status: status},

                    success: function(response){
                        if(response.status == 'success'){
                            location.reload();
                        }else{
                            Swal.fire({ text: response.message, icon: "error", buttonsStyling: !1, confirmButtonText: "Okay", customClass: { confirmButton: "btn fw-bold btn-primary" } }).then(function (result) { if(result.isConfirmed){ location.reload() } });;
                        }
                    },
                    error: function(error){
                        Swal.fire({ text: 'Something went wrong', icon: "error", buttonsStyling: !1, confirmButtonText: "Okay", customClass: { confirmButton: "btn fw-bold btn-primary" } }).then(function (result) { if(result.isConfirmed){ location.reload() } });;
                    }
                });
        }else{


            if($this.is(":checked")){
                $this.prop('checked', false);
            }
            else{
                $this.prop('checked', true);
            }

        }
    });

});
/* END status update */

/*Begin approval status update Ajax*/
$(document).on('submit','#approval_status_form',function(e){
    e.preventDefault();
    var form_url    = $(this).attr('action');
    var form_data   = $(this).serialize();
    $.ajax({
        url: form_url,
        type: 'POST',
        data: form_data,
        success: function(response){
            if(response.status == 'success'){
                location.reload();
            }else{
                Swal.fire({ text: 'Something went wrong', icon: "error", buttonsStyling: !1, confirmButtonText: "Okay", customClass: { confirmButton: "btn fw-bold btn-primary" } }).then(function (result) { if(result.isConfirmed){ location.reload() } });;
            }
        },
        error: function(error){
             Swal.fire({ text: 'Something went wrong', icon: "error", buttonsStyling: !1, confirmButtonText: "Okay", customClass: { confirmButton: "btn fw-bold btn-primary" } }).then(function (result) { if(result.isConfirmed){ location.reload() } });;
        }
    });
});
/* END approval status update Ajax*/

/* Begin  date picker*/
$(".datepicker").flatpickr();
/* end date picker*/
$(function () {
    $('.datepicker').flatpickr({
        minDate: 0,
        dateFormat: "m-d-Y",
    });
});


/* reset filter button start*/
    $('#reset_filter_btn').on('click', function () {
        $('#filter_form').trigger('reset');
        $('#user_type').val(null).trigger('change');
        $('#fromdate').val(null).trigger('change');
        $('#todate').val(null).trigger('change');
        $('#status').val(null).trigger('change');
        $('#bulk_update_status').val(null).trigger('change');
        $('#approval_status').val(null).trigger('change');
        $('#subscription_status').prop('checked',false);
        $('#subscription_status').val(null).trigger('change');
    });
/* reset filter end*/

$(document).on('click', '.change_status_class',function(event){
    $('#reject_reason_div').hide();
    $('#approval_status_form').attr('action',$(this).data('url'));
    $('#reason_model').modal('show');
    $('#approv_status').empty();
    $('#reject_reason_div').hide();
    $(this).val('');
    $('#approve_status').change(function(){
        if($('#approve_status').val() == "2") {
            $('#reject_reason_div').show();
        } else {
            $('#reject_reason_div').hide();
        }
    });
    $('#reason_model').on('hidden.bs.modal', function () {
        $('#reject_reason_div').hide();
    });
    $('#close_reason_modal').on('click', function () {
        $('#reason_model').modal('hide');
    });
});

/* mobile number field input mask */
$(document).ready(function(){
   $('.mobile_input_mask').inputmask('(999)-999-9999');
});

