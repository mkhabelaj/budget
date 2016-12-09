/**
 * Created by jmkha on 12/2/2016.
 */
friendSearchRefreshItemList = function () {$("#search").keyup()};
notification = function(){getNotification()};
createFriendList =  function () {getAnyPost(home+"controller/createFriendList.php",null,"#friendList");}

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
     * this makes the friend request button clickable
     */

    $('body').on('click', '.friendRequest', function (){
        $("#search").keyup()
        getAnyPostE(home+"controller/friendRequest.php",{requestee: $(this).val() },"#search",{friendRefresh:friendSearchRefreshItemList});

    });
    /**
     * this makes the friend accept button clickable
     */
    $('body').on('click','.acceptFriendRequet',function () {
        getAnyPostE(home+"controller/acceptFriendRequest.php",{requester: $(this).val()},null,{friendRefresh:friendSearchRefreshItemList,notify:notification,recreateFriendList:createFriendList});

    });

    /**
     * this part of the code makes the the friend list
     */
    createFriendList();
});


