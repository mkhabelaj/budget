/**
 * Created by JacksonM on 2016-12-06.
 */
var budgetID;
//var home ="http://localhost:8080/";
var home = "http://budget.dev/";

$(document).ready(function () {
    $("#addFriendList").hide();

    $(document).on('click', function(e){

        if(e.target.id !== "addFriendList"){
           // console.log("we are getting somewhere");
            $("#addFriendList").hide();
        }
        if($(e.target).hasClass("addFriendToBudget")){
            budgetID = $(e.target).val();
            //getFriendListBudget();

            getAnyPost(home+"controller/budgetFriendList.php",{budgetId : budgetID},"#addFriendList")
            $("#addFriendList").show();

        }

    });


});

