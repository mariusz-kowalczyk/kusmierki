$(function() {
    $('#save-new-gallery').click(function() {
       if($('#new-gallary-form').validationEngine('validate')) {
           $('#new-gallary-form').submit();
       }
    });
    
});

var uploader;

Gallery = {
    initUploader: function(options) {
        uploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight',
            browse_button : 'select-images-button',
            container: document.getElementById('images-upload-container'),

            // Flash settings
            flash_swf_url : '/libs/plupload/Moxie.swf', 
            // Silverlight settings
            silverlight_xap_url : '/libs/plupload/Moxie.xap',

            drop_element: document.getElementById('drop-upload-images'),

            url : options.uploadUrl,

            filters : {
                max_file_size : '10mb',
                mime_types: [
                    {title : "Image files", extensions : "jpg,gif,png,jpeg"},
                ]
            },

            init: {
                PostInit: function() {
                    $('#messages-upload-images').empty();
                },
                FilesAdded: function(up, files) {
                    uploader.start();
                },
                UploadProgress: function(up, file) {
                    var $div;
                    if($('#progres-image-upload-' + file.id).length) {
                        $div = $('#progres-image-upload-' + file.id);
                    }else {
                        $div = $('#empty-progress-item').clone();
                        $div.attr('id', 'progres-image-upload-' + file.id).find('.image-name').html(file.name);
                        $div.appendTo('#progress-upload-images').show();
                    }
                    $div.find('.progress-bar').css({width: file.percent + '%'}).attr('aria-valuenow', file.percent).find('.percent-value').html(file.percent);
                },

                Error: function(up, err) {
                    var $m = $('<div/>').addClass('alert alert-danger').html(err.message);
                    $('#messages-upload-images').append($m);
                    setTimeout(function() {
                        $m.remove();
                    }, 3000);                    
                },
                FileUploaded: function(up, file, ret) {
                    $('#progres-image-upload-' + file.id).remove();
                    try {
                        var response = JSON.parse(ret.response);
                    }catch(err) {
                        console.log('FileUploaded', err);
                    }
                    if(response.success) {
                        var image = response.image;
                        var $div = $('#empty-image-el').clone();
                        $div.removeAttr('id').insertBefore('#empty-image-el');
                        var base_url = $div.find('a').attr('href');
                        $div.find('a').attr('href', base_url + image.id + '/orginal').find('img').attr('src', base_url + image.id + '/128').attr('alt', image.name)
                                .parents('.image-el').find('.name').html(image.name);
                        $div.show();
                    }else {
                        var $m = $('<div/>').addClass('alert alert-danger').html(response.messsage);
                        $('#messages-upload-images').append($m);
                        setTimeout(function() {
                            $m.remove();
                        }, 3000);  
                    }
                }
            }
        });
        
        uploader.init();
    }
}