// $(function(){
// $('.edit-modal-open').on('click',function(){
//     $('.calender_js-modal').fadeIn();
//     var setting_reserve = $(this).attr('setting_reserve');
//     var setting_part = $(this).attr('setting_part');
//     var reserve_setting_id = $(this).attr('reserve_setting_id');
//     $('.modal-inner-setting_reserve').val(setting_reserve);
//     $('.modal-inner-setting_part').text(setting_part);
//     $('.edit-modal-hidden_calender').val(reserve_setting_id);
//     return false;
//   });
//   $('.calender_js-modal-close').on('click', function () {
//     $('.calender_js-modal').fadeOut();
//     return false;
//   });

// const { data } = require("alpinejs");

// });

document.querySelectorAll('.calender_js-modal-open').forEach(function(btn){
  btn.addEventListener('click', function(){

    const date = this.dataset.date;
    const part = this.dataset.part;
    const reserveSettingId = this.dataset.reserveSettingId;

    document.getElementById('modalDate').textContent =date;
    document.getElementById('modalPart').textContent =part;
    document.getElementById('modalReserveSettingId').value =reserveSettingId;
    
    document.getElementById('cancelModal').style.display = 'block';
  });
});

document.getElementById('calender_js-modal-close').addEventListener('click', function(){
  document.getElementById('cancelModal').style.display ='none';
});