/**
 * Created with JetBrains PhpStorm.
 * User: dmitry
 * Date: 6/10/13
 * Time: 11:27 PM
 * To change this template use File | Settings | File Templates.
 */
$(function(){
    $("#city-changed").click(function(){
        $.colorbox({
            href: "#change-city-window",
            inline: true,
            width: "500px"
        });
        return false;
    });
})