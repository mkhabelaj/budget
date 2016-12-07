/**
 * Created by JacksonM on 2016-12-05.
 */
//var home ="http://localhost:8080/";
var home = "http://budget.dev/";
function getAllnotifications() {
    $.post(
        home+"controller/notification.php",
        function (data) {
            $("#allNotifications").html(data);
        });
}

$(document).ready(function () {
    getAllnotifications();

    $('body').on('click', '.acceptFriendR', function (){
        //console.log($(this).val());
        $.post(
            home+"controller/acceptFriendRequest.php",
            {
                requester: $(this).val()

            },
            function (data, status) {
                console.log(data);
                getAllnotifications();
                getNotification();
            }

        );
    });
});
