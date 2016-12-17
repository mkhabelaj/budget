/**
 * Created by JacksonM on 2016-12-05.
 */
//var home ="http://localhost:8080/";
var home = "http://budget.dev/";

/**
 * An anonymous function that updates notification counter
 */
updateNotifactionAnon = function () {getNotification()}

$(document).ready(function () {

    /**
     * this Section updates the notification counter using a timer
     */
    getNotification();
    setInterval(function(){ getNotification(); }, 20000);


});

/**
 * updates the notification counter for the site
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
function getAnyPost(url,queryObject,element) {
    $.post(url,queryObject,function (data) {
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
function getAnyPostE(url,queryObject,element,execution) {
    $.post(url,queryObject,function (data) {
        if(element) {
            $(element).html(data);
        }
            $.each(execution,function (key,value) {
                value();
            });
    });
}

/**
 * this section notifies the user of any changes
 * it updates the notification table
 */
function notifyUserOfChanges(queryObect,element,execution) {
    getAnyPostE(home+"controller/sendNotification.php",queryObect,element,execution);
}
/**
 * finds the difference between days
 * @param dateOne
 * @param dateTwo
 * @returns {number}
 */
Date.daysInBetween =  function (dateOne,dateTwo) {
    var oneDay = 1000*60*60*24;

    var dateOneMilliS = dateOne.getTime();
    var dateTwoMilliS = dateTwo.getTime();

    var difference = dateTwoMilliS - dateOneMilliS;

    return Math.round(difference/oneDay);

}

/**
 * this function adds days to the day
 * @param date
 * @param days
 * @returns {Date}
 */
Date.addDaysToDate = function (date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

/**
 * this counts the of days in a date
 * this also increments month for you
 * @returns {number}
 */
Date.prototype.daysInMonth= function(){
    var d= new Date(this.getFullYear(), this.getMonth()+1, 0);
    return d.getDate();
}