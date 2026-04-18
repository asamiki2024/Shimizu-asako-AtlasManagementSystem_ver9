$(function(){
$('.edit-modal-open').on('click',function(){
    $('.calender_js-modal').fadeIn();
    var setting_reserve = $(this).attr('setting_reserve');
    var setting_part = $(this).attr('setting_part');
    var reserve_setting_id = $(this).attr('reserve_setting_id');
    $('.modal-inner-setting_reserve').val(setting_reserve);
    $('.modal-inner-setting_part').text(setting_part);
    $('.edit-modal-hidden_calender').val(reserve_setting_id);
    return false;
  });
  $('.calender_js-modal-close').on('click', function () {
    $('.calender_js-modal').fadeOut();
    return false;
  });

});
