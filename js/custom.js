jQuery(document).on({
    ajaxStart: function() { jQuery("body").addClass("loading");  },
    ajaxStop: function() { jQuery("body").removeClass("loading"); }
});
 
