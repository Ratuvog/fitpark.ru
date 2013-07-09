CKEDITOR.editorConfig = function( config ) {
 
    config.toolbarGroups = [
        { name: 'tools' },
        { name: 'undo' },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'colors' }
    ];
    config.autoUpdateElement = true;
    config.language = 'ru';
    config.uiColor = '#009900';
    config.height = '300px';
    config.resize_enabled = false;
    config.removePlugins = '';
    config.extraPlugins = 'onchange'; // add plugin
};   


