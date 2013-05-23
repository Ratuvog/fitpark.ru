/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    $(".fancybox").fancybox();

    /* Поиск по клубу    */
    var BLACK = "rgb(0, 0, 0)";
    $("#submit-search").click(function(){
        $(this).parents('form').submit();
    })
    $(".not-empty").focusin(function(){
        if($(this).css("color")!==BLACK)
            $(this).val("");
        $(this).css("color","black");
    })

    $(".not-empty").focusout(function(){
        if($(this).val()==="") {
            $(this).css("color","gray");
            $(this).val($(this).attr('place'));
        }
    })

    var nonEmptyText = $(".not-empty");
    nonEmptyText.val(nonEmptyText.attr('place'));
    nonEmptyText.css("color","gray");

    $(".action-button").click(function(){
        var href = $(this).attr("href");
        var selectorForm = $(this).attr("selector");
        $(selectorForm+" form").attr("action", href);
        $(selectorForm+" form").on("click", ".button-send", checkForm);
        $.colorbox({
            href: selectorForm,
            inline: true
        });
    })
})

