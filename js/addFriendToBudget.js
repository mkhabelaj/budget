/**
 * Created by JacksonM on 2016-12-06.
 */
var budgetID;
var home ="http://localhost:8080/";
//var home = "http://budget.dev/";

/**
 * this is th anonymous function that gets of the users friends that are not part of the budget specified
 */
usersNotInBudgetAnon = function () {getAnyPost(home+"controller/budgetFriendList.php",{budgetId : budgetID},"#addFriendList")};

$(document).ready(function () {


    $("#addFriendList").hide();

    $(document).on('click', function(e){

        if(e.target.id !== "addFriendList"){
           // console.log("we are getting somewhere");
            $("#addFriendList").hide();
        }
        if($(e.target).hasClass("budgetFriendItem")){
            console.log(true);
            $("#addFriendList").show();

        }
        if($(e.target).hasClass("addFriendToMyB")){
            console.log(true);
            $("#addFriendList").show();
            /**
             * adds a users friend to their budget
             */
            getAnyPostE(home+"controller/addFriendToBudget.php",{budgetId:budgetID,friendID:$(e.target).val()},null,{refresh:usersNotInBudgetAnon});
        }

        if($(e.target).hasClass("addFriendToBudget")){
            budgetID = $(e.target).val();

            /**
             * this section gets of the users friends that are not part of the budget specified
             */
            usersNotInBudgetAnon();
            $("#addFriendList").show();
       }

    });



});

