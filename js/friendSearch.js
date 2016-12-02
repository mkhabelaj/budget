/**
 * Created by jmkha on 12/2/2016.
 */
$(Document).ready(function () {
    $("#search").keyup(function () {
        //console.log($(this).val());
        $.post("http://budget.dev/controller/friendSearch.php",
            {
                query: $(this).val()
            },
            function (data,status) {
                $("#filterSearch").html(data);
            }

        );
    });

});