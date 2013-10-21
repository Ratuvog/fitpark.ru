// Времменный костыль для удаления всех кастомных стилей редактора и установка собственных

$(function(){
    $(".ckeditor-text p, " +
        ".ckeditor-text ul, " +
        ".ckeditor-text li, " +
        ".ckeditor-text span," +
        ".ckeditor-text h2").each(function(){
        $(this).removeAttr("style");
    })
})