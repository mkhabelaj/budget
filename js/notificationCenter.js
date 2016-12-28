/**
 * Created by JacksonM on 2016-12-05.
 */

notifications = function () {getAllnotifications()}
notificationsCounter = function () {getNotification();}
/**
 * this function gets friend requests
 */
function getAllnotifications() {
    getAnyPost(home+"controller/notification.php",null,".modal-sub-content");
}

$(document).ready(function () {

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

    /**
     * this area insert notifications into modal
     */
    $('body').on('click','#open-modal-notification',function (event) {
        event.preventDefault();
        console.log('working');
        notifications();
    });
});
