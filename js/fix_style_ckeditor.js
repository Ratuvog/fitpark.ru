// Времменный костыль для удаления всех кастомных стилей редактора и установка собственных

$(function(){
    $(".ckeditor-text *").each(function(){
        $(this).removeAttr("style");
    })
})