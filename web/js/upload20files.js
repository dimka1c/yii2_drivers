$( document ).ready( function() {

    var files;
    var id_one; // первый элемент в массиве для стилизации кнопки при начале запроса

    $('input[type=file]').change(function(){
        $('.progress-bar').html( '0%' );
        $(".progress-bar").css("width", 0+'%');
        $('#messageLoading').hide();
        files = this.files;//console.log( this.files );
        if ( files != null ) {
            $('#load').html("");
        }
        for ( var i = 0; i <= files.length-1; i++ ) {
            var id = files[i].name.match('[a-zA-Z0-9_]+')[0]; // удаляем расширение с точкой (file.xls -> file)
            if (id_one == null) {
                id_one = id;
            }
            $('#load').append('<label class="btn btn-default loading" id="'+id+'">'+id+'</label>');
        }
    });

    $('.submit.button').click(function( event ){
        event.stopPropagation(); // Остановка происходящего
        event.preventDefault();  // Полная остановка происходящего

        var data = new FormData();
        $.each( files, function( key, value ){
            data.append( 'upfile[]', value ); // upfile[] специально для формирования модели Yii2 UploadedFiles
        });

        // Создадим данные формы и добавим в них данные файлов из files

            // не отправлять запрос пока не вернулся ответ от сервера
            $.ajax({
                xhr: function()
                {
                    var xhr = new window.XMLHttpRequest();
                    // прогресс загрузки на сервер
                    xhr.upload.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = ( evt.loaded / evt.total ) * 100;
                            $('.progress-bar').html( Math.round( percentComplete ));
                            $(".progress-bar").css("width", percentComplete+'%');
                        }
                    }, false);
/*                    // прогресс скачивания с сервера
                    xhr.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            // делать что-то...
                        }
                    }, false);
*/
                    return xhr;
                },
                url: '/upload/upload-file',
                type: 'post',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false, // Не обрабатываем файлы (Don't process the files)
                contentType: false, // Так jQuery скажет серверу что это строковой запрос
                success: function( respond, textStatus, jqXHR ) {
                    //console.log( 'ответ от сервера ' + respond );
                    $('#'+respond).removeClass('btn-default').addClass('btn-success');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    errors = true;
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
            });
    });

    $('.reset-button').click( function( event ) {
        // очистка поля [input=file]
        $( "input[name*='UploadForm[upfile][]']" )[1].value="";
        $('#load').html('Нет файлов для загрузки');
    });
});