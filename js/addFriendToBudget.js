/**
 * Created by JacksonM on 2016-12-06.
 */
var budgetID;

/**
 * this is th anonymous function that gets of the users friends that are not part of the budget specified
 */
usersNotInBudgetAnon = function () {getAnyPost(home+"controller/budgetFriendList.php",{budgetId : budgetID},".modal-sub-content")};

$(document).ready(function () {




    $(document).on('click', function(e){

        if($(e.target).hasClass("addFriendToMyB")){
            console.log(true);
            $("#addFriendList").show();
            /**
             * adds a users friend to their budget
             */
            postAny(home+"controller/addFriendToBudget.php",{budgetId:budgetID,friendID:$(e.target).val()},null,{refresh:usersNotInBudgetAnon});
        }

        if($(e.target).hasClass("addFriendToBudget")){
            budgetID = $(e.target).val();
            /**
             * this section gets of the users friends that are not part of the budget specified
             */
            usersNotInBudgetAnon();

       }

    });



});

