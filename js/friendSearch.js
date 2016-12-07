/**
 * Created by jmkha on 12/2/2016.
 */
friendSearchRefreshItemList = function () {$("#search").keyup()};
notification = function(){getNotification()};

var home ="http://localhost:8080/";
//var home = "http://budget.dev/";

/**
 * this is the ajax filter search
 */
$(Document).ready(function () {
    $("#search").keyup(function () {
        getAnyPost(home+"controller/friendSearch.php",  {query: $(this).val()},"#filterSearch");
    });
    /**
     * this make the friend request button clickable
     */

    $('body').on('click', '.friendRequest', function (){
        $("#search").keyup()
        getAnyPostE(home+"controller/friendRequest.php",{requestee: $(this).val() },"#search",{friendRefresh:friendSearchRefreshItemList});

    });
    /**
     * this make the friend accept button clickable
     */
    $('body').on('click','.acceptFriendRequet',function () {
        getAnyPostE(home+"controller/acceptFriendRequest.php",{requester: $(this).val()},null,{friendRefresh:friendSearchRefreshItemList,notify:notification});
        // $.post(
        //     home+"controller/acceptFriendRequest.php",
        //     {
        //         requester: $(this).val()
        //     },
        // function (data) {
        //     console.log(data);
        //     $("#search").keyup();
        //     //friendList();
        //     getAnyPost(home+"controller/createFriendList.php",null,"#friendList");
        //     getNotification();
        // }
        // );
    });

    /**
     * this part of the code makes the the friend list
     */
    getAnyPost(home+"controller/createFriendList.php",null,"#friendList");

});


