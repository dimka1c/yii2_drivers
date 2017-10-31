/**
 * Created by User on 018 18.10.17.
 */
$(document).ready(function() {
    function timer() {
        var data = new Date();
        //console.log(data);
        var time = {
            data : data.getDate(),
            month : data.getMonth(),
            year : data.getFullYear(),
            hours : data.getHours(),
            minutes : data.getMinutes(),
            seconds : data.getSeconds()
        };
        //console.log(time);

        switch (time.month)
        {
            case 0: fMonth="января"; break;
            case 1: fMonth="февраля"; break;
            case 2: fMonth="марта"; break;
            case 3: fMonth="апреля"; break;
            case 4: fMonth="мае"; break;
            case 5: fMonth="июня"; break;
            case 6: fMonth="июля"; break;
            case 7: fMonth="августа"; break;
            case 8: fMonth="сентября"; break;
            case 9: fMonth="октября"; break;
            case 10: fMonth="ноября"; break;
            case 11: fMonth="декабря"; break;
        }

        $("#days").text(time.data + " " + fMonth + " " + time.year);
        $("#hours").text(time.hours < 10 ? '0' + time.hours : time.hours);
        $("#minutes").text(time.minutes < 10 ? '0' + time.minutes : time.minutes);
        $("#seconds").text(time.seconds < 10 ? '0' + time.seconds : time.seconds);
    }
    setInterval(timer, 1000);

    $("#login_form").submit(function(e) {
        e.preventDefault();
        var form = $("#login_form").serialize();
        console.log(form);
        $.ajax({
            type: 'POST',
            url: '/main/login',
            //dataType: 'json',
            data: form,
            success: function(data) {
                console.log("success : " + data);
            },
            error: function (data) {
                console.log("error: " + data);
            }
        });
    });

    $("#login").focus(function(){
        console.log(document.forms);
    });

});