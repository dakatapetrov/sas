$(document).ready(function() {
  var imgUp = '/sas/src/public/img/glyphicons/glyphicons_223_chevron-up.png';
  var imgDown = '/sas/src/public/img/glyphicons/glyphicons_223_chevron-down.png';

  $('.info').hide();

  $('tr').on('click', function(e) {
    e.preventDefault();
    if($(this).next().is(":visible")) {
      $(this).find('img').attr('src', imgDown);
    } else {
      $(this).find('img').attr('src', imgUp);
    }
    $(this).next().toggle();
  })
});
