/**
 * Created by JacksonM on 2016-12-05.
 */

notifications = function () {getAllnotifications()}
notificationsCounter = function () {getNotification();}
/**
 * this function gets friend requests
 */
function getAllnotifications() {
    getAnyPost(home+"controller/notification.php",null,"#allNotifications");
}

$(document).ready(function () {
   notifications();

    /**
     * this accepts a friend request on the notification center tab
     */
    $('body').on('click', '.acceptFriendR', function (){
        getAnyPostE(home+"controller/acceptFriendRequest.php",{requester: $(this).val()},null,{notifiy:notifications,updateCounter:notificationsCounter})
        notifyUserOfChanges({requestersID:$(this).val(),type:"accepted"},null,null);
    });

    /**
     * these section is used to dismiss a notification
     */
    $('body').on('click', '.dismiss', function (){
        getAnyPostE(home+"controller/dismissNotification.php",{notficationID: $(this).val()},null,{notifiy:notifications,updateCounter:notificationsCounter})
    });

});
