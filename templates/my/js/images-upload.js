var icms = icms || {};

icms.images = (function ($) {

    this.uploadCallback = null;
    this.removeCallback = null;

    //====================================================================//

    this.upload = function(field_name, upload_url){

        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader-'+field_name),
            action: upload_url,
            multiple: false,
            debug: false,

            onSubmit: function(id, fileName){
                var widget = $('#widget_image_'+field_name);
                $('.upload', widget).hide();
                $('.loading', widget).show();
            },

            onComplete: function(id, file_name, result){

                var widget = $('#widget_image_'+field_name);

                if(!result.success) {
                    alert(result.error);
                    $('.upload', widget).show();
                    $('.loading', widget).hide();
                    return;
                }

                preview_img_src = null;

                $('.data', widget).html('');

                for(var path in result.paths){
                    preview_img_src = result.paths[path].url;
                    $('.data', widget).append('<input type="hidden" name="'+field_name+'['+path+']" value="'+result.paths[path].path+'" />');
                }

                $('.preview img', widget).attr('src', preview_img_src);
                $('.preview', widget).show();
                $('.loading', widget).hide();

                if (typeof(icms.images.uploadCallback) == 'function'){
                    icms.images.uploadCallback(field_name, result);
                }

            }

        });

    }

    //====================================================================//

    this.createUploader = function(field_name, upload_url){

        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader-'+field_name),
            action: upload_url,
            debug: false,

            onComplete: function(id, file_name, result){

                if(!result.success) {
                    return;
                }

                var idx = $('.data input:last', widget).attr('rel');
                if (typeof(idx) == 'undefined') { idx = 0; } else { idx++; }

                var widget = $('#widget_image_'+field_name);
                var preview_block = $('.preview_template', widget).clone().removeClass('preview_template').addClass('preview').attr('rel', idx).show();

                $('img', preview_block).attr('src', result.paths.small.url);
                $('a', preview_block).click(function() { icms.images.removeOne(field_name, idx); });

                $('.previews_list', widget).append(preview_block);

                for(var path in result.paths){
                    $('.data', widget).append('<input type="hidden" name="'+field_name+'['+idx+']['+path+']" value="'+result.paths[path].path+'" rel="'+idx+'" />');
                }

            }

        });

    }

    //====================================================================//

    this.remove = function(field_name){

        var widget = $('#widget_image_'+field_name);
        $('.preview', widget).hide();
        $('.preview img', widget).attr('src', '');
        $('.upload', widget).show();
        $('.loading', widget).hide();
        $('.data', widget).html('');

        if (typeof(icms.images.removeCallback) == 'function'){
            icms.images.removeCallback(field_name, result);
        }

    }

    //====================================================================//

    this.removeOne = function(field_name, idx){

        var widget = $('#widget_image_'+field_name);

        $('.data input[rel='+idx+']', widget).remove();
        $('.preview[rel='+idx+']', widget).remove();

        var count = 0;
        var current = false;

        if (typeof(icms.images.removeCallback) == 'function'){
            icms.images.removeCallback(field_name, idx);
        }

    }

    //====================================================================//

	return this;

}).call(icms.images || {},jQuery);
