$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });

   $('.main_categories').click(function () {
    $('.sub_category_inner'. category_id).slideToggle();
  });

// $('.main_categories_conditions').click(function () {
//       const targetSubcategory = this.nextElementSibling;
//   });

//   if (targetSubcategory.style.display === 'none') {
//             targetSubcategory.style.display = 'block';
//         } else {
//             targetSubcategory.style.display = 'none';
//         }

  // 動かなかった記述
// const category =
//   document.querySelectorAll('.main_categories');

// const sub =
//   document.querySelectorAll('.sub_category');
  

//   category.forEach(category => {
//     category.addEventListener('click', function(){

//       const category_id =
//       this.dataset.category;

//       sub.forEach(sub => {
//         sub.classList.remove('open');
//       });

//       subs.forEach(sub => {

//         if(sub.dataset.category === category_id) {
//           sub.classList.add('open');
//         }
//       });
//     });
//   });



});