/**
 * Created by JacksonM on 2016-12-19.
 */

/**
 * this section updates and loads budget
 */
var insertBudgetview = function () {
    postAny(home+"controller/budgetViewController.php",{budgetId:$.urlParam('budget_instance_id')},"#budget-view",null);
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
        postAny(home+"controller/catergoryAmount.php",parameters,".error-category",{refreshBudget:insertBudgetview});
    });

    /**
     * this section gets a form and adds it to the modal content
     */
    $('body').on('click','#add-catagory',function () {
        postAny(home+"templates/modalFormAddCatagory.php",null,".modal-sub-content",null);
});

    /**
     * this section recognises when budgetview table row is clicked and insets the table row into
     * the modal as a form
     */
    $('body').on('click','#actualBudget',function (event) {

        var currencyCode = $(event.target.parentNode).children(":first-child").attr('data-currency');
        console.log(currencyCode);
        var category = $(event.target.parentNode).children(":first-child").html();
        var categoryValue = $(event.target.parentNode).children(":first-child").attr('data-category-id').replace('<span>'+currencyCode+'&nbsp;</span>','');
        var projectedAmount = parseFloat($(event.target.parentNode).children(":nth-child(2)").html().replace('<span>'+currencyCode+'&nbsp;</span>',''));
        var atualAmount =parseFloat($(event.target.parentNode).children(":nth-child(3)").html().replace('<span>'+currencyCode+'&nbsp;</span>',''));
        var content ='<div class="form-container">' +
                        '<form>' +
                            '<div class="edit-table-row-budget-view">' +
                                '<label for="category-edit">Category</label> ' +
                                '<input id="category-edit" type="text" value="'+category+'">'+
                                '<label for="projected-amount-edit">Projected Amount</label> ' +
                                '<input id="projected-amount-edit" type="number" step="any" value="'+projectedAmount+'">' +
                                '<label for="actual-amount-edit">Actual Amount</label> ' +
                                '<input id="actual-amount-edit" type="number" step="any" value="'+atualAmount+'">' +
                                '<button id="edit-row" type="submit" data-category-id="'+categoryValue+'">edit</button>' +
                                '<button id="delete-row" type="submit" data-category-delete-id="'+categoryValue+'">DELETE</button>' +
                            '</div>' +
                        '</form> ' +
                    '</div>';
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

        postAny(home+"controller/editBudgetViewRowController.php",parameters,'#central-error',{refreshbudgetview:insertBudgetview,modalClose:closeModal});
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

        postAny(home+"controller/deleteBudgetViewRowController.php",parameters,'#central-error',{refreshbudgetview:insertBudgetview,modalClose:closeModal});
    });

    /**
     * inserts all incomes into modal
     */

    $('body').on('click','#income-open',function () {

        parameter = {
            timeLineID : $(this).attr('data-time-id'),
            budgetID : $(this).attr('data-budget-id')
        }
        postAny(home+"controller/listOfIncomes.php",parameter,'.modal-sub-content',null);


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
        postAny(home+"controller/incomeController.php",parameter,'#central-error',{refreshBudgetView:insertBudgetview,closeM:closeModal});


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
        postAny(home+"controller/incomeControllerDelete.php",parameter,'#central-error',{refreshBudgetView:insertBudgetview,closeModa:closeModal});


    });
    /**
     * edits income in database
     */

    var incomeIDEdit = 0;

    $('body').on('click','.income-edit',function (event) {
        var description = $(event.target.parentNode).children(":first-child").html();
        var income =  $(event.target.parentNode).children(":nth-child(3)").html();

        incomeIDEdit = $(this).attr("data-income-id-edit");

        var content ='<form class="edit-income-form">' +
                        '<label for="income-description-edit">IncomeDescription</label>' +
                        '<input id="income-description-edit" name="description-name" type="text" value="'+description+'">' +
                        '<label for="income-edit">Income </label>' +
                        '<input id="income-edit" name="amount-name" type="number" step="any" value="'+income+'">' +
                        '<button type="submit" class="submit-new-edit"> Edit</button>' +
                    '</form>';
        $('.modal-sub-content').html(content);

    });
    /**
     * updates income
     */
    $('body').on('click','.submit-new-edit',function (event) {
        event.preventDefault();
        var $form = $(".edit-income-form");
        var data = getFormData($form);
        data["income-id"] = incomeIDEdit;
        postAny(home+"controller/incomeControllerEdit.php",data,'#central-error',{refreshBudgetView:insertBudgetview,closeModal:closeModal});


    });




});
