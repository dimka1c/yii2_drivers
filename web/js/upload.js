$( document ).ready( function() {

    var files;
    var id_one; // первый элемент в массиве для стилизации кнопки при начале запроса

    $('input[type=file]').change(function(){
        $('#messageLoading').hide();
        files = this.files;//console.log( this.files );
        for ( var i = 0; i <= files.length-1; i++ ) {
            //console.log(files[i]);
            //console.log(files[i].name);
            var id = files[i].name.match('[a-zA-Z0-9_]+')[0]; // удаляем расширение с точкой (file.xls -> file)
            if (id_one == null) {
                id_one = id;
                //console.log(id_one);
            }
            //console.log(id);
            $('#load').append('<label class="btn btn-default loading" id="'+id+'">'+id+'</label>');
        }

    });

    $('.submit.button').click(function( event ){
        event.stopPropagation(); // Остановка происходящего
        event.preventDefault();  // Полная остановка происходящего

        // Создадим данные формы и добавим в них данные файлов из files

        var data = new FormData();
        $.each( files, function( key, value ){
            data.append( 'upfile[]', value ); // upfile[] специально для формирования модели Yii2 UploadedFiles
        });

        $.ajax({
            url: '/upload/upload-file',
            type: 'post',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Не обрабатываем файлы (Don't process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function( respond, textStatus, jqXHR ) {
                console.log(respond);
                $('#messageText').html('Файлы успешно загружены');
                $('#messageLoading').slideDown();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                $('#messageTitle').html('При загрузке произошла ошибка');
                $('#messageText').html('Файлы не загружены');
                $('#messageLoading').removeClass('alert-success').addClass('alert-danger').slideDown();

            },
            beforeSend: function () {
                var loadId = '#' + id_one;
                $(loadId).removeClass('btn-default').addClass('btn-warning').html('Загрузка...');
                return true;
            }
        });

    });
});