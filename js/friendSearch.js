/**
 * Created by jmkha on 12/2/2016.
 */

var home ="http://localhost:8080/";
//var home = "http://budget.dev/";

/**
 * this is the ajax filter search
 */
$(Document).ready(function () {
    $("#search").keyup(function () {
        //console.log($(this).val());
        $.post(home+"controller/friendSearch.php",
            {
                query: $(this).val()
            },
            function (data,status) {
                $("#filterSearch").html(data);
            }

        );
    });
    /**
     * this make the friend request button clickable
     */

    $('body').on('click', '.friendRequest', function (){
       //console.log($(this).val());
        $.post(
            home+"controller/friendRequest.php",
            {
                requestee: $(this).val()

            },
            function (data, status) {
                console.log(data);
                $("#search").keyup();
            }

        );
    });
    /**
     * this make the friend accept button clickable
     */
    $('body').on('click','.acceptFriendRequet',function () {
        $.post(
            home+"controller/acceptFriendRequest.php",
            {
                requester: $(this).val()
            },
        function (data) {
            console.log(data);
            $("#search").keyup();
            friendList();
            getNotification();
        }
        );
    });

    /**
     * this part of the code makes the the friend list
     */
    friendList();



});
/**
 * this gets the friendlist
 */
function friendList() {
    $.post(
        home+"controller/createFriendList.php",
        function (data) {
            $("#friendList").html(data);
        }
    );
}

