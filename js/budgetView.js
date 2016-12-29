/**
 * Created by JacksonM on 2016-12-19.
 */

/**
 * this section updates and loads budget
 */
var insertBudgetview = function () {
    getAnyPostE(home+"controller/budgetViewController.php",{budgetId:$.urlParam('budget_instance_id')},"#budget-view",null);
}
$(document).ready(function () {
    /**
     * this section updates and loads budget
     */
    insertBudgetview();

    /**
     * this section insert into catogory and catogory amounts
     */
    $('body').on('click','#addRow',function () {
        console.log($('#add-catagory').attr('data-budgetID'));
        var parameters = {
            budgetId:$('#add-catagory').attr('data-budgetID'),
            timelineID:$('#add-catagory').attr('data-timeID'),
            projectedA:$('#projected-amount').val(),
            actualA:$('#actual-amount').val(),
            category:$('#Category').val()
        }
        getAnyPostE(home+"controller/catergoryAmount.php",parameters,null,{refreshBudget:insertBudgetview});
    });

    /**
     * this section gets a form and adds it to the modal content
     */
    $('body').on('click','#add-catagory',function () {
        getAnyPostE(home+"templates/modalFormAddCatagory.php",null,".modal-sub-content",null);
    });

    $('body').on('click','#actualBudget',function (event) {
        event.target.toLocaleString()
        console.log("table is click"+ event.target.parentNode.nodeName)
        console.log($(event.target.parentNode).children(":first-child").html())
        var category = $(event.target.parentNode).children(":first-child").html();
        var projectedAmount =$(event.target.parentNode).children(":nth-child(2)").html();
        var atualAmount =$(event.target.parentNode).children(":nth-child(3)").html();
        var content ='<div><input value="'+category+'"><input value="'+projectedAmount+'"><input value="'+atualAmount+'"></div>';
        $('.modal-sub-content').html(content);
    });


});
