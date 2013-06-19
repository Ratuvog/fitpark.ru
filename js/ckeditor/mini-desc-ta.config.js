CKEDITOR.editorConfig = function( config ) {
 
    config.toolbarGroups = [
        { name: 'undo' },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'colors' },
    ];
    
    config.language = 'ru';
    config.uiColor = '#009900';
    config.height = '90px';
    config.resize_enabled = false;
    config.removePlugins = '';
    config.extraPlugins = 'wordcount'; // add plugin
    config.wordcount = {
    showWordCount: false,
    showCharCount: true,
    charLimit: 255,
    lang : 'ru'
    };
};   


