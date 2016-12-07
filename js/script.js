/**
 * Created by JacksonM on 2016-12-05.
 */
//var home ="http://localhost:8080/";
var home = "http://budget.dev/";

$(document).ready(function () {

    getNotification();
    setInterval(function(){ getNotification(); }, 20000);

});
/**
 * updates the notification for the site
 */
function getNotification() {
    getAnyPost(home+"controller/notificationCounter.php",null,".notification");
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
