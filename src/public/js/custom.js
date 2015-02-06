$(document).ready(function() {
  $('.info').hide();

  $('tr').on('click', function(e) {
    e.preventDefault();
    $(this).next().toggle();
  })
});
