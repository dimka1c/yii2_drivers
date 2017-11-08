$( document ).ready( function() {

    var files;
    var id_one; // первый элемент в массиве для стилизации кнопки при начале запроса
    var qFiles = 0; // количество файлов для загрузки
    var qQueryForSave = 0; // количество запросов отправлено для сохранения
    var percentComplete = 0;
    var qAnswer = 0; // получено ответов о сохранении файла

    $('input[type=file]').change(function(){
        $('.progress-bar').html( '0%' );
        $(".progress-bar").css("width", 0+'%');
        $('#messageLoading').hide();
        $('#showPercentLoading').show();
        files = this.files;//console.log( this.files );
        if ( files != null ) {
            $('#load').html("");
        }
        for ( var i = 0; i <= files.length-1; i++ ) {
            var id = files[i].name.match('[a-zA-Z0-9_]+')[0]; // удаляем расширение с точкой (file.xls -> file)
            if (id_one == null) {
                id_one = id;
            }
            $('#load').append('<label class="btn btn-default loading" id="'+id+'">'+id+' <span id="yesLoad" class=""></span></label>');
        }
        qFiles = files.length; // количество файлов к загрузке
        qQueryForSave = 0;
        qAnswer = 0;
        percentComplete = 0;
    });



    $('.submit.button').click(function( event ){
        event.stopPropagation(); // Остановка происходящего
        event.preventDefault();  // Полная остановка происходящего

        qQueryForSave = 0;
        qAnswer = 0;
        percentComplete = 0;

        $('#messageLoading').hide();
        for (var i = 0; i <= files.length-1; i++) {
            var id = files[i].name.match('[a-zA-Z0-9_]+')[0]; // удаляем расширение с точкой (file.xls -> file)
            $('#'+id).removeClass('btn-success').addClass('btn-default');
        }
        $('#showPercentLoading').show();

        data = new FormData();
        $.each( files, function( key, value ){
            data.append( 'upfile[]', value ); // upfile[] специально для формирования модели Yii2 UploadedFiles
        });

        // Создадим данные формы и добавим в них данные файлов из files

        // обходим ограниечение сервера в 20 файлов и каждый файл сохраняем отдельно
        // также сделаем визуализацию загрузки для каждого файла


        for (var value of data.values()) {
            $('.progress-bar').html( '0%' );
            $(".progress-bar").css("width", 0+'%');
            var val = "";
            val = new FormData();
            val.append('upfile[]', value);

            var ajax = $.ajax({
                    url: '/upload/upload-file',
                    type: 'post',
                    data: val,
                    cache: false,
                    dataType: 'json',
                    processData: false, // Не обрабатываем файлы (Don't process the files)
                    contentType: false, // Так jQuery скажет серверу что это строковой запрос
                    success: function( respond, textStatus, jqXHR ) {
                        //console.log( 'ответ от сервера ' + respond );
                        $('#'+respond).removeClass('btn-default').addClass('btn-success');
                        $('#'+respond+' span').addClass('glyphicon glyphicon-ok').css('color', 'white');
                        qAnswer++;
                        percentComplete = Math.round((qAnswer / qFiles ) * 100);
                        $('.progress-bar').html( Math.round( percentComplete ) + '%');
                        $(".progress-bar").css("width", percentComplete+'%');
                        if ( percentComplete == 100) {
                            $('#messageTitle').html('Сообщение');
                            $('#messageText').html('Файлы успешно загружены.');
                            $('#messageLoading').slideDown();
                            $('#showPercentLoading').hide();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        errors = true;
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                        $('#messageTitle').html('Ошибка!!!');
                        $('#messageText').html('Файлы не загружены');
                        $('#messageLoading').removeData('alert-success').addClass('alert-danger').slideDown();
                        $('#showPercentLoading').hide();
                    },
                    beforeSend: function() {
                        qQueryForSave++;
                    }
                });
        };
    });

    $('.reset-button').click( function( event ) {
        // очистка поля [input=file]
        $( "input[name*='UploadForm[upfile][]']" )[1].value="";
        //$('#load').html('Нет файлов для загрузки');
    });
});