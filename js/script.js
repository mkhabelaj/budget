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
/**
 * function to send of get any post
 * @param url
 * @param queryString
 * @param element
 */
function getAnyPost(url,queryString,element) {
    $.post(url,queryString,function (data) {
        if(element)
            $(element).html(data);
    });
}
/**
 * function to send of get any post but also allow for any number of async executions
 * @param url
 * @param queryString
 * @param element
 * @param execution
 */
function getAnyPostE(url,queryString,element,execution) {
    $.post(url,queryString,function (data) {
        if(element) {
            $(element).html(data);
            //execution();
        }
            $.each(execution,function (key,value) {
                value();
            });
    });
}
