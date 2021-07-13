$(document).ready( function(){
  $('#rd').load(week9.php);
refresh();
  });
   
  function refresh()
  {
    setTimeout( function() {
      $('#rd').fadeOut('slow').load(week9.php).fadeIn('slow');
      refresh();
    }, 2000);
  }