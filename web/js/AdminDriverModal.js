$( document ).ready( function() {

    var intervalID;

/*
    $(".drivername").on("click", function (e) {
        var intervalID = setTimeout(function() {
            //var drivername = $(this).html();
            console.log(e.clientX + "  " + e.clientY);
            $(".service").css({'left': e.clientX , 'top': e.clientY + 5});
            $(".service").fadeIn();
        }, 500);
    });
*/
     $(".drivername").on("click", function (e) {
         console.log(e.clientX + "  " + e.clientY);
         /*
         var visible = $(".service").is(":visible");
         if ($(".service").is(":visible") == true) {
             $(".service").fadeOut();
         }
         */
         $(".service").css({'left': e.clientX , 'top': e.clientY + 5});
         $(".service").fadeIn();
     });

/*
    $(".service").mouseout(
        function () {
            //console.log(this);
            $(".service").fadeOut();
            clearInterval(intervalID);
        }
    );
*/

    $(document).mouseup(function (e) {
        var container = $(".service");
        if (container.has(e.target).length === 0){
            container.hide();
        }
    });

});

