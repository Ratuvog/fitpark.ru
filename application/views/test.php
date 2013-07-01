<div class="user-input">
    <div class="club-logo-input">
        <span class="btn btn-success fileinput-button">
            <i class="icon-plus icon-white"></i>
            <span>Add files...</span>
            <input id="fileupload" type="file" name="files[]" multiple>
        </span>
        <div id="files" class="files"></div>
    </div>
</div>
<link rel="stylesheet" href="http://blueimp.github.io/cdn/css/bootstrap.min.css">
<link rel="stylesheet" href="http://blueimp.github.io/cdn/css/bootstrap-responsive.min.css">
<link rel="stylesheet" href="/assets/fileupload/css/jquery.fileupload-ui.css">
<link rel="stylesheet" href="/assets/fileupload/css/style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="http://blueimp.github.io/JavaScript-Load-Image/load-image.min.js"></script>
<script src="/assets/fileupload/js/vendor/jquery.ui.widget.js"></script>
<script src="/assets/fileupload/js/jquery.fileupload.js"></script>
<script src="/assets/fileupload/js/jquery.fileupload-process.js"></script>
<script src="/assets/fileupload/js/jquery.fileupload-image.js"></script>
<script src="/assets/fileupload/js/jquery.iframe-transport.js"></script>
<script src="/assets/fileupload/js/jquery.fileupload-audio.js"></script>
<script src="/assets/fileupload/js/jquery.fileupload-video.js"></script>
<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = (window.location.hostname === 'blueimp.github.io' ||
                window.location.hostname === 'blueimp.github.io') ?
                '//jquery-file-upload.appspot.com/' : 'server/php/',
        uploadButton = $('<button/>')
            .addClass('btn')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator && navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append(file.error);
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            var link = $('<a>')
                .attr('target', '_blank')
                .prop('href', file.url);
            $(data.context.children()[index])
                .wrap(link);
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.result.files, function (index, file) {
            var error = $('<span/>').text(file.error);
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    });
});
</script>