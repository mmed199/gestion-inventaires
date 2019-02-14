    $(function() {
        $('.addhomefeatured a.product_link').each( function (){
            var obj_h2 = $(this);
            var h2_title = obj_h2.html();
            var words = h2_title.split(' ');
            words[0] = '<span>' + words[0] + '</span><strong class="clear"></strong>'
            obj_h2.html( words.join( ' ' ) );
        } );
    });

$(function () {
 $(window).scroll(function () {
  if ($(this).scrollTop() > 100) {
   $('#toTop').fadeIn();
  } else {
   $('#toTop').fadeOut();
  }
 });

 // scroll body to 0px on click
 $('#toTop').click(function () {
  $('body,html').stop(false, false).animate({
   scrollTop: 0
  }, 800);
  return false;
 });
});

