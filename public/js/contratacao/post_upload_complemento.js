$(document).ready(function() {

    $(":file").fileinput({
        fileActionSettings: {
        },
        theme: 'fa',
        language: 'pt-BR',
        uploadUrl: '', // arrumar
        uploadAsync: false,
        minFileCount: 1,
        maxFileCount: 20,
        overwriteInitial: false,
        previewFileIcon: '<i class="fas fa-file"></i>',
        allowedPreviewExtensions: ["pdf","zip", "jpg", "png", "jpeg"],
        allowedFileExtensions: ["jpg", "jpeg", "png","pdf", "zip", "rar", "7z"],
        msgInvalidFileExtension: "O tipo de arquivo selecionado não é suportado. Favor selecionar um arquivo de imagem, PDF ou ZIP." ,
        purifyHtml: true,
        uploadExtraData: { 
            function() {
                return {

                userid: $("#matricula").val(),
                username: $("#matricula").val(),
                responsavelAtual: $('#matricula').val(),
                observacoesAgencia: $('#observacoesAgencia').val(),
                }; 
            }
        },

        preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
             previewFileIconSettings: { // configure your icon file extensions
            'doc': '<i class="fas fa-file-word text-primary"></i>',
            'xls': '<i class="fas fa-file-excel text-success"></i>',
            'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
            'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
            'zip': '<i class="fas fa-file-archive text-muted"></i>',
            'htm': '<i class="fas fa-file-code text-info"></i>',
            'txt': '<i class="fas fa-file-text text-info"></i>',
            'mov': '<i class="fas fa-file-video text-warning"></i>',
            'mp3': '<i class="fas fa-file-audio text-warning"></i>',
            // note for these file types below no extension determination logic 
            // has been configured (the keys itself will be used as extensions)
            'jpg': '<i class="fas fa-file-image text-danger"></i>', 
            'gif': '<i class="fas fa-file-image text-muted"></i>', 
            'png': '<i class="fas fa-file-image text-primary"></i>'    
        },
        previewFileExtSettings: { // configure the logic for determining icon file extensions
            'doc': function(ext) {
                return ext.match(/(doc|docx)$/i);
            },
            'xls': function(ext) {
                return ext.match(/(xls|xlsx)$/i);
            },
            'ppt': function(ext) {
                return ext.match(/(ppt|pptx)$/i);
            },
            'zip': function(ext) {
                return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
            },
            'htm': function(ext) {
                return ext.match(/(htm|html)$/i);
            },
            'txt': function(ext) {
                return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
            },
            'mov': function(ext) {
                return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
            },
            'mp3': function(ext) {
                return ext.match(/(mp3|wav)$/i);
            }
        }
        });


    $('#formUploadComplemento').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData($(this).get(0)); // Creating a formData using the form.
        $.ajax({
            method: 'POST',
            url: 'backend/post_teste2.php',
            dataType: 'json',
            cache: false,
            processData: false, // Important!
            contentType: false, // Important! I set dataType above as Json
            data: formData, // Important! The formData should be sent this way and not as a dict.
            // beforeSend: function(xhr){xhr.setRequestHeader('X-CSRFToken', "{{csrf_token}}");},
            success: function(data, textStatus) {
                console.log(data);
                console.log(formData);
                console.log(textStatus);
            },
            error: function (textStatus, errorThrown) {
                console.log(errorThrown);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    });
        

}); // fecha document ready
