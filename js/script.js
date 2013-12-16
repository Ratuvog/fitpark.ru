jQuery(document).ready(function(){

   $("#seo-blocks ul:first").css("border-left", "none");

    $(".checkbox")
        .on("click", function(){
            if(!$(this).children().prop("checked")) {
                $(this).addClass("checked");
                $(this).children().first().prop("checked", true);
            } else {
                $(this).removeClass("checked");
                $(this).children().first().prop('checked', false);
            }
        })
        .each(function(){
            if($(this).children().prop("checked")) {
                $(this).addClass("checked");
            }
        });

   if($("#sidebar-options").css("display") == "block"){
        $(".item-result").css("margin", "0 18px");
        $(".item-result").css("margin-left", "5px");
        $("#search-results").css("margin-left", "315px");
   }

   jQuery.os =  { name: (/(win|mac|linux|sunos|solaris|iphone)/.exec(navigator.platform.toLowerCase()) || [u])[0].replace('sunos', 'solaris') };
   //alert(jQuery.os.name);
   if(jQuery.os.name == 'mac'){
        $("#top-search form").css("position", "relative").css("top", "-3px");
   }
});