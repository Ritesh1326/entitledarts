jQuery( document ).ready(function() {
  jQuery('.theme-group-menu li a').on('click', function() {
    jQuery('.theme-group-menu li a').removeClass("active");
    jQuery(this).addClass("active");
    //get href 
    var _divId = jQuery(this).attr("id");

    // Make the content visible
    jQuery('.theme-main .theme-group-tab').removeClass('visible');
    jQuery('.theme-main').find("div#"+_divId).addClass('visible');

  });
  
  show_content(0);

  function show_content(index) {
    
  }
});
