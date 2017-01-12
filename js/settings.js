/**
 * Created by JacksonM on 2017-01-12.
 */

$('#change-currency').submit(function (event) {
    event.preventDefault();
    console.log($("#curency").val());
    parameter = {
        currencyCode:$("#curency").val(),
        formName:$(this).attr('id')
    };
    getAnyPostE(home+"controller/settingsController.php",parameter,null,null);
});