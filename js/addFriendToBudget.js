/**
 * Created by JacksonM on 2016-12-06.
 */
var budgetID;
var home ="http://localhost:8080/";
//var home = "http://budget.dev/";

$(document).ready(function () {
    $("#addFriendList").hide();

    $(document).on('click', function(e){

        if(e.target.id !== "addFriendList"){
           // console.log("we are getting somewhere");
            $("#addFriendList").hide();
        }
        if($(e.target).hasClass("addFriendToBudget")){
            budgetID = $(e.target).val();
            getFriendListBudget();
            $("#addFriendList").show();

        }

    });


});

function getFriendListBudget() {
    $.post(home+"controller/budgetFriendList.php",
        {
            budgetId : budgetID
        },
        function (data) {
            $("#addFriendList").html(data);
        }

    );
}