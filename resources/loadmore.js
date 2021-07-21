jQuery(function($){
  let button = $( '#loadmore a' );
  let box = button.parents('.actions-page__wrap');
  button.click( function( event ) {
  event.preventDefault();
  const ajax_url = window.my_ajax_object.ajax_url || false;
    $.ajax({
      type : 'POST',
      url : ajax_url, // получаем из wp_localize_script()
      data : {
        action : 'loadmore', // экшен для wp_ajax_ и wp_ajax_nopriv_
      },
      beforeSend : function() {
        button.text( 'Загружаем...' );
      },
      success : function(data){
        box.after(data);
        button.remove();
      },
    });
  } );

  let reviewBtn = $( '#loadmore-reviews a' );
  let reviewBox = $('.reviews-block__item:last-of-type');
  reviewBtn.click( function( event ) {
    event.preventDefault();
    const ajax_url = window.my_ajax_object.ajax_url || false;
    $.ajax({
      type : 'POST',
      url : ajax_url, // получаем из wp_localize_script()
      data : {
        action : 'loadmore_review', // экшен для wp_ajax_ и wp_ajax_nopriv_
      },
      beforeSend : function() {
        reviewBtn.text( 'Загружаем...' );
      },
      success : function(data){
        reviewBox.after(data);
        reviewBtn.remove();
      },
    });
  } );
});
