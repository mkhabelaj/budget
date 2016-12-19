/**
 * Created by JacksonM on 2016-12-13.
 */

//TODO: ensure that when any action is taken the endate will automatically update
/**
 * this section use jquery date picker
 */
$( function() {
    $( "#startDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
} );

$(Document).ready(function () {
    //makes endDate readonly
    $("#endDate").prop("readonly", true);

    $("#startDate").change(function () {
        var startDate = $(this).val();
        startDate = startDate.split('-');
        var endDate;
        var temp1= (parseInt(startDate[1]));
        numberOFDaysNextMonth = new Date((parseInt(startDate[0])),temp1+1,0).daysInMonth();
        numberOFDaysThisMonth = new Date((parseInt(startDate[0])),(temp1-1),0).daysInMonth();

        if(startDate[1] == 12 && $("#frequency").val() === "monthly"){
            new Array((parseInt(startDate[0])+1),(startDate[1]),startDate[2]).join("-");
            $("#endDate").val(new Array((parseInt(startDate[0])+1),"01",startDate[2]).join("-"));
        }else {
            var month="";

            if( (parseInt(startDate[1])) >= 10){
                var monthIncrement= (parseInt(startDate[1]));
                monthIncrement++;
                month=month+monthIncrement;
            }else {
                var monthIncrement= (parseInt(startDate[1]));
                monthIncrement++;
                month="0"+monthIncrement;
            }

            if(parseInt(startDate[2]) >= numberOFDaysNextMonth ){
                $("#endDate").val(new Array((parseInt(startDate[0])),month,numberOFDaysNextMonth).join("-"))
            }else {
                $("#endDate").val(new Array((parseInt(startDate[0])),month,startDate[2]).join("-"));
            }

        }

        if($("#frequency").val() === "weekly"){
            console.log("hi");

            endDate = new Date(startDate[0],(startDate[1]-1),startDate[2]);
            endDate = Date.addDaysToDate(endDate,7);
            var endDateArray = endDate.toDateString().split(" ");
            endDateArray.shift();
            endDateArray = monthToNumber(endDateArray)
            $("#endDate").val(endDateArray.join("-"));

        }

        if($("#frequency").val() === "biweekly"){

            endDate = new Date(startDate[0],(startDate[1]-1),startDate[2]);
            endDate = Date.addDaysToDate(endDate,14);
            var endDateArray = endDate.toDateString().split(" ");
            endDateArray.shift();
            endDateArray = monthToNumber(endDateArray)
            $("#endDate").val(endDateArray.join("-"));

        }

    })

});

/**
 * this function converts month in array to numeral and rearranges array
 * @param x
 * @returns {*}
 */
function monthToNumber(x) {
    var dates ={
        Jan:"01",
        Feb:"02",
        Mar:"03",
        Apr:"04",
        May:"05",
        Jun:"06",
        Jul:"07",
        Aug:"08",
        Sep:"09",
        Oct:"10",
        Nov:"11",
        Dec:"12"
                }
   x[0]= dates[x[0]];
    var year = x[2];
    var day = x[1];
    x[2]= day;
    x[1] = x[0];
    x[0]= year;
    return x;
}

