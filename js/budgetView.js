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
    $('body').on('click','#addRow',function (event) {
        event.preventDefault();
        $('.error-category').empty();
        console.log($('#add-catagory').attr('data-budgetID'));
        var parameters = {
            budgetId:$('#add-catagory').attr('data-budgetID'),
            timelineID:$('#add-catagory').attr('data-timeID'),
            projectedA:$('#projected-amount').val(),
            actualA:$('#actual-amount').val(),
            category:$('#Category').val()
        }
        getAnyPostE(home+"controller/catergoryAmount.php",parameters,".error-category",{refreshBudget:insertBudgetview});
    });

    /**
     * this section gets a form and adds it to the modal content
     */
    $('body').on('click','#add-catagory',function () {
        getAnyPostE(home+"templates/modalFormAddCatagory.php",null,".modal-sub-content",null);
});

    /**
     * this section recognises when budgetview table row is clicked and insets the table row into
     * the modal as a form
     */
    $('body').on('click','#actualBudget',function (event) {
        var category = $(event.target.parentNode).children(":first-child").html();
        var categoryValue = $(event.target.parentNode).children(":first-child").attr('data-category-id').replace('<span>R&nbsp;</span>','');
        var projectedAmount =$(event.target.parentNode).children(":nth-child(2)").html().replace('<span>R&nbsp;</span>','');
        var atualAmount =$(event.target.parentNode).children(":nth-child(3)").html().replace('<span>R&nbsp;</span>','');
        var content ='<form>' +
                        '<div class="edit-table-row-budget-view">' +
                            '<label for="category-edit">Category</label> ' +
                            '<input id="category-edit" type="text" value="'+category+'">'+
                            '<label for="projected-amount-edit">Projected Amount</label> ' +
                            '<input id="projected-amount-edit" value="'+projectedAmount+'">' +
                            '<label for="actual-amount-edit">Actual Amount</label> ' +
                            '<input id="actual-amount-edit"  value="'+atualAmount+'">' +
                            '<button id="edit-row" type="submit" data-category-id="'+categoryValue+'">edit</button>' +
                            '<button id="delete-row" type="submit" data-category-delete-id="'+categoryValue+'">DELETE</button>' +
                        '</div>' +
                    '</form>';
        $('.modal-sub-content').html(content);
    });

    /**
     * this section send the row to a processor to before updated on the database
     */
    $('body').on('click','#edit-row',function (event) {
        event.preventDefault();
        var parameters = {
            budgetID:$('#add-catagory').attr('data-budgetID'),
            timelineID:$('#add-catagory').attr('data-timeID'),
            categoryID:$(this).attr('data-category-id'),
            category:$("#category-edit").val(),
            actualAmount:$("#actual-amount-edit").val(),
            projectedAmount:$("#projected-amount-edit").val()
        }

        getAnyPostE(home+"controller/editBudgetViewRowController.php",parameters,'#central-error',{refreshbudgetview:insertBudgetview,modalClose:closeModal});
    });

    /**
     * this section send the row to a processor to before it is deleted from budget
     */
    $('body').on('click','#delete-row',function (event) {
        event.preventDefault();
        var parameters = {
            budgetID:$('#add-catagory').attr('data-budgetID'),
            timelineID:$('#add-catagory').attr('data-timeID'),
            categoryID:$(this).attr('data-category-delete-id'),
            category:$("#category-edit").val(),
            actualAmount:$("#actual-amount-edit").val(),
            projectedAmount:$("#projected-amount-edit").val()
        }

        getAnyPostE(home+"controller/deleteBudgetViewRowController.php",parameters,'#central-error',{refreshbudgetview:insertBudgetview,modalClose:closeModal});
    });

    /**
     * inserts all incomes into modal
     */

    $('body').on('click','#income-open',function () {

        parameter = {
            timeLineID : $(this).attr('data-time-id'),
            budgetID : $(this).attr('data-budget-id')
        }
        getAnyPostE(home+"controller/listOfIncomes.php",parameter,'.modal-sub-content',null);


    });
    /**
     * inserts new income to database
     */
    $('body').on('click','#submit-new-income',function (event) {
        event.preventDefault();
        parameter = {
            timeLineId : $(this).attr('data-time-line-id-submit'),
            budgetId : $(this).attr('data-budget-id-submit'),
            description:$('#income-description').val(),
            income:$('#amount-income').val()

        }
        getAnyPostE(home+"controller/incomeController.php",parameter,'.modal-sub-content',{refreshBudgetView:insertBudgetview});


    });
    /**
     * deletes income from budget
     */

    $('body').on('click','.income-delete',function () {
        parameter = {
            timeLineId : $('#submit-new-income').attr('data-time-line-id-submit'),
            budgetId : $('#submit-new-income').attr('data-budget-id-submit'),
            income:$(this).attr('data-income-id-delete')

        }
        getAnyPostE(home+"controller/incomeControllerDelete.php",parameter,'.modal-sub-content',{refreshBudgetView:insertBudgetview});


    });




});
