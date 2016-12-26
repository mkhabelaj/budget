/**
 * Created by JacksonM on 2016-12-19.
 */

$(document).ready(function () {
    /**
     * this section updates and loads budget
     */
    getAnyPostE(home+"controller/budgetViewController.php",{budgetId:$.urlParam('budget_instance_id')},"#test",null);

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
        getAnyPostE(home+"controller/catergoryAmount.php",parameters,"#test",null);
    });

    /**
     * this section gets a form and adds it to the modal content
     */
    $('body').on('click','#add-catagory',function () {
        getAnyPostE(home+"templates/modalFormAddCatagory.php",null,".modal-sub-content",null);
    });
});
