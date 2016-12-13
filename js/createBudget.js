/**
 * Created by JacksonM on 2016-12-13.
 */


$(Document).ready(function () {

    // $("#startDate").click(function () {
    //     console.log($(this).val());
    // });

    $("#startDate").change(function () {
        //console.log($(this).val());
        var startDate = $(this).val();
        startDate = startDate.split('-');
        console.log(startDate);

        // var s = new Date(startDate[2],startDate[0]-1,startDate[1]);
        // var sn = new Date(startDate[2]+1,startDate[0]-1,startDate[1]);
        console.log(startDate[2]);
        //console.log(sn);


        //console.log(Date.daysInBetween(sn,s));

    })

});

