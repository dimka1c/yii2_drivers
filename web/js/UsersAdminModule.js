$( document ).ready( function() {

    /********************************************
     / кнопка Активировать/Запретить
     / срабатывает при двойном щелчке мыши
     *********************************************/
    $(":button").on('dblclick', function(e) {
        e.preventDefault();
        var elem = $(this);
        var ajax = $.ajax({
            url: '/admin/main/users',
            type: 'post',
            data: 'action=access&id=' + elem.attr('id'),
            cache: false,
            dataType: 'json',
            success: function( respond, textStatus, jqXHR ) {
                console.log("success: " + respond);
                if (respond == 1) {
                    $(elem).removeClass('btn-danger').addClass('btn-success').html('<span class="glyphicon glyphicon-ok-circle"></span> Разрешить');
                } else {
                    $(elem).removeClass('btn-success').addClass('btn-danger').html('<span class="glyphicon glyphicon-remove-circle"></span> Запретить');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("error: " + textStatus);
            },
        });
    });


    /********************************************
    / открываем модальное окно для редактирования
    *********************************************/
    $(".user_edit").on('click', function(e) {
        e.preventDefault();
        var idUser = $(this).attr('id');
        var ajax = $.ajax({
            url: '/admin/main/view-user',
            type: 'post',
            data: 'id=' + idUser,
            cache: false,
            dataType: 'json',
            success: function( respond, textStatus, jqXHR ) {
                $("#myModal").modal({
                    keyboard: true,
                });
                // заполняем модаль данными
                $('#modalUserID').val(respond.id);
                $('#inputFullName').val(respond.fullname);
                $('#inputEmail').val(respond.email);
                $('#inputLogin').val(respond.username);
                $('#dataRegistration').val(respond.data_registration);
                if (respond.access == 1) {
                    $('#inputAccess').attr('checked', 'checked');
                } else {
                    $('#inputAccess').removeAttr('checked');
                }
                var role = respond.role; // роль пользователя
                // в цикле записываем роли в select
                var roles = "";
                $.each(respond[0], function(index, value){
                    //console.log("INDEX: " + index + " VALUE: " + value);
                    if (role == index) {
                        roles += '<option value="' + index + '" selected>' + value + '</option>';
                    } else {
                        roles += '<option value="' + index + '">' + value + '</option>';
                    }
                });
                $('#modalUserRole').html(roles);
                // показываем модальное окно
                $("#myModal").modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#modalForm").html('<div>Ошибка получения данныхю Обратитесь к администратору.</div>');
                $("#myModal").modal('show');
            }
        });
    });


    /****************************************
     / модальное окно - сохранение данных
    *****************************************/
    $("#modalSave").on("click", function() {
        val = $('#modalForm').serialize();
        console.log(val);
        var ajax = $.ajax({
            url: '/admin/main/save-user',
            type: 'post',
            data: val,
            cache: false,
            dataType: 'json',
            success: function( respond, textStatus, jqXHR ) {
                if ( respond == false ) { // данные успешно изменены
                    $('#modalSaveMessage').html('Ошибка обновления данных');
                } else if ( respond != false ) {
                    // данные успешно обновлены
                    $('#modalSaveMessage').html('Данные обновлены');
                    // и изменяем данные на основной странице в таблице
                    $('[id='+ respond +'][class = user_edit]').html($('#inputFullName').val());
                    $('[id=email_'+ respond +'][class = td_email]').html($('#inputEmail').val());

                };
            },
            error: function() {
                $('#modalSaveMessage').html('Ошибка обновления данных');
            },
        });
    });

});
