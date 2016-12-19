/**
 * Created by JacksonM on 2016-12-19.
 */

$(document).ready(function () {
    console.log($.urlParam('budget_instance_id'));
    getAnyPostE(home+"controller/budgetViewController.php",{budgetId:$.urlParam('budget_instance_id')},"#test",null);
});
