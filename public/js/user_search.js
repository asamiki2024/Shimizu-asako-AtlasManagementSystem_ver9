$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });


$('.main_categories_conditions').click(function () {
      this.nextElementSibling;
    $('.sub_category_inner').slideToggle('open');
  });

  // 動かなかった記述
// const main_categories_conditions =
//   document.querySelectorAll('.main_categories_conditions');

//   main_categories_conditions.forEach(main => {
//     main_categories_conditions.addEventListener('click', function(){
//       const sub_category_inner =
//         this.nextElementSibling;
//         sub_category_inner.classList.toggle('open');
//     })
//   })



});