$(document).ready(function(){
	
});

$(function() {
    // $('input[name="ck_menu"]').on('click', function() {
    $(document).on('click', '.ck_menu', function(){  
        if ($(this).val() == '2') {
            $('#menu_sub').show();
        }
        else {
            $('#menu_sub').hide();
        }
    });
});
$(function() {
    // $('input[name="ck_menu_modal"]').on('click', function() {
    $(document).on('click', '.ck_menu_modal', function(){  
        if ($(this).val() == '2') {
            $('#menu_sub_modal').show();
        }
        else {
            $('#menu_sub_modal').hide();
        }
    });
});
$(function() {
     $(document).on('click', '.ck_link', function(){  
    // $('input[name="ck_link"]').on('click', function() {
        if ($(this).val() == '2') {
            $('#external').show();
            $('#local').hide();
            $('#validation').hide();
            $('#local_sub').removeClass('warning_validation');
            $('#link_local').removeClass('warning_validation');
        }
        else {
            $('#validation_external').hide();
            $('#external_check').removeClass('warning_name_validation');
            $('#local').show();
            $('#external').hide();
        }
    });
});
$(function() {
    $(document).on('click', '.ck_link_modal', function(){  
    // $('input[name="ck_link_modal"]').on('click', function() {
        if ($(this).val() == '2') {
            $('#external_modal').show();
            $('#local_modal').hide();
            $('#validation_modal').hide();
            $('#local_sub_modal').removeClass('warning_validation');
            $('#link_local_sub').removeClass('warning_validation');
        }
        else {
            $('#validation_external_modal').hide();
            $('#external_modal_check').removeClass('warning_name_validation');
            $('#local_modal').show();
            $('#external_modal').hide();
        }
    });
    $(document).on('click', '.del-menu', function(){
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type'); 

        $('#id_del').val(id);
        $('#id_type').val(type);
        $('#modal-warning').modal('show');
    });
    $(document).on('click', '.del-menu', function(){
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type'); 

        $('#id_del').val(id);
        $('#id_type').val(type);
        $('#modal-warning').modal('show');
    });
    $(document).on('click', '.del-menu-sub', function(){
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type'); 

        $('#id_delsub').val(id);
        $('#id_typesub').val(type);
        $('#modal-default-delete_sub').modal('show');
    });
});