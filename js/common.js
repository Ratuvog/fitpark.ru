/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    $("#window-checkout .button-send").click(function(){
        $(this).parents('form').first().submit();
    })

    $(".action-button").click(function(){
        var href = $(this).attr("href");
        $("#window-checkout form").attr("action", href);
        $.colorbox({
            href: "#window-checkout",
            inline: true
        });
    })
})

