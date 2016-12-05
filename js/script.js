/**
 * Created by JacksonM on 2016-12-05.
 */

$(document).ready(function () {

    getNotification();
    setInterval(function(){ getNotification(); }, 50000);

});

function getNotification() {
    $.post(
        "http://localhost:8080/controller/notificationCounter.php",
        function (data) {
            console.log(data);
            $(".notification").html(data);

        }
    );
}
