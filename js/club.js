/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    // Tabs
    $("#image-club").hide();
//    $("#review-club").hide();
    $(".tab-set > table").delegate('a','click',function(){
        var parentCell = $(this).parents('td');
        if(!parentCell.first().hasClass('tab'))
            return false;
        var parentTable = $(this).parents('table');
        parentTable.find('td').each(function(){
            $(this).removeClass('active-tab');
            var selector = $(this).attr("selector");
            $(selector).hide();
        })
        parentCell.addClass('active-tab');
        var selector = parentCell.attr("selector");
        $(selector).show();
        return false;
    })

    $(".submit-review").click(function(){
        $(this).parents('form').first().submit();
    })
})

