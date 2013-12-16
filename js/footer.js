$(function(){
    var clickSocIcon = function(socNetwork) {
        var share42 = $("#share42").find('a[title*="'+socNetwork+'"]');
        return function(e) {
            share42.trigger("click");
        }
    }
    $("#google").click(clickSocIcon("Google"));
    $("#fb").click(clickSocIcon("VK"));
    $("#vk").click(clickSocIcon("Facebook"));
    $("#tw").click(clickSocIcon("Twitter"));
})