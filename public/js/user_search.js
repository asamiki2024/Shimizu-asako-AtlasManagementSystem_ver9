$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });

  //  $('.main_categories').click(function () {
  //   // console.log('');
  //   let category_id = $(this).attr('category_id');
  // console.log(category_id);
  //   // $('.sub_category_inner category_id').slideToggle();
  // });

      $('.main_categories').click(function () {
        var category_id = $(this).attr('category_id');
        $('.sub_category_inner' + category_id).slideToggle();
        $(this).toggleClass('open');
      });


  
  // $('.main_categories').click(function () {
  //   console.log('.sub_category_inner');
  //   let category_id = $(this).attr('category_id');
  // console.log(category_id);
  //   // $('.sub_category_inner category_id').slideToggle();
  // });

// $('.main_categories_conditions').click(function () {
//       const targetSubcategory = this.nextElementSibling;
//   });

//   if (targetSubcategory.style.display === 'none') {
//             targetSubcategory.style.display = 'block';
//         } else {
//             targetSubcategory.style.display = 'none';
//         }

  // 動かなかった記述
// const main_categories =
//   document.querySelectorAll('.main_categories');

// const sub_category =
//   document.querySelectorAll('.sub_category');
  

//   category.forEach( main_categories=> {
//     main_categories.addEventListener('click', function(){

//       const category_id =
//       this.dataset.main_categories;

//       sub.forEach( sub_category=> {
//         sub_category.classList.remove('open');
//       });

//       sub_category.forEach( category_id=> {

//         if(sub_category.dataset.category_id === category_id) {
//           sub_category.classList.add('open');
//         }
//       });
//     });

// document.querySelectorAll('.main_categories-open')(function(){
//   sub_category_inner.addEventListener('click', function(){
    
//     const sub_category_inner = this.dataset.sub_category_inner;
//     data-sub_category_inner="$(this).attr('category_id'); ";
//     document.getElementById('category_id').textContent =category_id;
//   });
  
//   document.getElementById('.main_categories-close').addEventListener('click', function(){
//     document.getElementById('.main_categories').style.display ='none';
//   });
//   });
});