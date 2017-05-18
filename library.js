/**
 * gets element by title
 * @param elementName
 * @param title
 * @returns {jQuery|HTMLElement}
 */
function getInputByTile(elementName,title) {
    return  $(elementName+"[title='"+title+"']");
}
/**
 *
 * @param text
 * @returns {XML|void|string|*}
 */
RegExp.escape = function(text) {
    text = text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
    return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
}

/**
 *
 * @param holidays
 * @param startDate
 * @param endDate
 * @returns {*}
 */
function numberOfLeaveDays(holidays,startDate, endDate){
    //console.log('numberOfLeaveDays function');

    var totalNumberOfLeave = 0;
    var from  = new Date(splitStringtoArray(startDate)[0],
        splitStringtoArray(startDate)[1]-1,
        splitStringtoArray(startDate)[2]);


    var to = new Date(splitStringtoArray(endDate)[0],
        splitStringtoArray(endDate)[1]-1,
        splitStringtoArray(endDate)[2]);

   // console.log('holidays ',this.holidays);

    this.holidays.forEach(function(item,index){
        // console.log('numberOfLeaveDays', totalNumberOfLeave );
        // console.log('holidays ',this.holidays);
        var convertedDate = new Date(splitStringtoArray(item)[0],
            splitStringtoArray(item)[1]-1,
            splitStringtoArray(item)[2]);

        // console.log('to',to );
        // console.log('convertedDate ',convertedDate );
        // console.log('from',from );

        if(convertedDate <= to && convertedDate >= from ){
            if(!isDateInWeekend(item )){
                totalNumberOfLeave +=1;
            }
        }
    });
    //console.log("totalNumberOfLeave",totalNumberOfLeave  );
    //set field value
    if(calcBusinessDays(from,to)!=0){
        return calcBusinessDays(from,to)-totalNumberOfLeave;
    }else{
        return calcBusinessDays(from,to);
    }
}
/**
 * checks if date falls on a weekend
 * @param date
 * @returns {boolean}
 */
function isDateInWeekend(date){
    //console.log('isDateInWeekend');

    var dateArray= splitStringtoArray(date);
    var myDate = new Date(dateArray[0],dateArray[1]-1,dateArray[2]);
    //console.log(myDate);

    if(!(myDate.getDay() % 6)){
        console.log('isDateInWeekend',myDate, 'true');
        return true;
    }
   // console.log(myDate);
   // console.log('isDateInWeekend',myDate, 'false');
    return false;
}
/**
 * splits date and returns and array
 * @param date
 * @returns {Array}
 */
function splitStringtoArray(date){
    return date.split("-").map(Number);
}

/**
 * calculates bussiness days
 * @param dDate1
 * @param dDate2
 * @returns {*}
 */
function calcBusinessDays(dDate1, dDate2) { // input given as Date objects
    var iWeeks, iDateDiff, iAdjust = 0;
    if (dDate2 < dDate1) return -1; // error code if dates transposed
    var iWeekday1 = dDate1.getDay(); // day of week
    var iWeekday2 = dDate2.getDay();
    iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1; // change Sunday from 0 to 7
    iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;
    if ((iWeekday1 > 5) && (iWeekday2 > 5)) iAdjust = 1; // adjustment if both days on weekend
    iWeekday1 = (iWeekday1 > 5) ? 5 : iWeekday1; // only count weekdays
    iWeekday2 = (iWeekday2 > 5) ? 5 : iWeekday2;

    // calculate differnece in weeks (1000mS * 60sec * 60min * 24hrs * 7 days = 604800000)
    iWeeks = Math.floor((dDate2.getTime() - dDate1.getTime()) / 604800000)

    if (iWeekday1 <= iWeekday2) {
        iDateDiff = (iWeeks * 5) + (iWeekday2 - iWeekday1)
    } else {
        iDateDiff = ((iWeeks + 1) * 5) - (iWeekday1 - iWeekday2)
    }

    iDateDiff -= iAdjust // take into account both days on weekend

    return (iDateDiff + 1); // add 1 because dates are inclusive
}

/**
 * Sets And Resolve PeoplePicker
 * if disbaled is true it will disable the peaple picker image
 * if hide image is true the x botton that clears the people will be hidden
 * @param fieldName
 * @param userAccountName
 * @param disabled
 * @param hideImage
 * @constructor
 */
function SetAndResolvePeoplePicker(fieldName, userAccountName,disabled,hideImage) {

    ExecuteOrDelayUntilScriptLoaded(function () {
        setTimeout(function () {
            var controlName = fieldName;

            var peoplePickerDiv = $("[id$='ClientPeoplePicker'][title='" + controlName + "']");

            //console.log("peoplePickerDiv",peoplePickerDiv[0] );

            var peoplePickerEditor = peoplePickerDiv.find("[title='" + controlName + "']");

            // console.log("peoplePickerEditor ",peoplePickerEditor );
            var spPeoplePicker = SPClientPeoplePicker.SPClientPeoplePickerDict[peoplePickerDiv[0].id];

            peoplePickerEditor.val(userAccountName);

            spPeoplePicker.AddUnresolvedUserFromEditor(true);

            //disable the field

            spPeoplePicker.SetEnabledState(disabled);
            spPeoplePicker.SetEnabledState(disabled);

            //hide the delete/remove use image from the people picker
            if(hideImage){
                //$('.sp-peoplepicker-delImage').css('display','none');
                getInputByTile('a','Remove person or group '+userAccountName).hide()
            }

        }, 20);
    }, 'clientpeoplepicker.js');

}
/**
 * disable PeoplePicker by title
 * @param fieldName
 */
function disablePeoplePicker(fieldName) {

    var pickerDiv = $("[id$='ClientPeoplePicker'][title='" + fieldName + "']");
    var peoplePicker = SPClientPeoplePicker.SPClientPeoplePickerDict[pickerDiv[0].id];
    //disable the field
    peoplePicker.SetEnabledState(false);
    //hide the delete/remove use image from the people picker
    //$('.sp-peoplepicker-delImage').css('display','none');
}

/**
 *a change event that will work for any input
 * @type {{setup: $.event.special.inputchange.setup, teardown: $.event.special.inputchange.teardown, add: $.event.special.inputchange.add}}
 */
$.event.special.inputchange = {
    setup: function() {
        var self = this, val;
        $.data(this, 'timer', window.setInterval(function() {
            val = self.value;
            if ( $.data( self, 'cache') != val ) {
                $.data( self, 'cache', val );
                $( self ).trigger( 'inputchange' );
            }
        }, 20));
    },
    teardown: function() {
        window.clearInterval( $.data(this, 'timer') );
    },
    add: function() {
        $.data(this, 'cache', this.value);
    }
};



/**
 * get user information using the AD user name and sets a global variable called otherUserId
 * @param userName
 * @constructor
 */
function GetUserIdFromUserName(userName) {
    /// according to the environment.
    //var prefix = "i:0#.w|sagoldcoin\\";
    var siteUrl = _spPageContextInfo.siteAbsoluteUrl;
    var accountName = userName;
    $.ajax({
        url: siteUrl + "/_api/web/siteusers(@v)?@v='" +
        encodeURIComponent(accountName) + "'",
        method: "GET",
        async: false,
        headers: { "Accept": "application/json; odata=verbose" },
        success: function (data) {
           // console.log("Received UserId " + data.d.Id);
           // console.log(JSON.stringify(data));
            otherUserId = data.d.Id;
        },
        error: function (data) {
            console.log(JSON.stringify(data));
            throw 'failure to Get User Id From UserName';
        }
    });
}
/**
 * clears a field client picker fields
 * @param fieldName
 */
function clearPeoplePicker(fieldName) {
    ExecuteOrDelayUntilScriptLoaded(function () {
            setTimeout(function () {
                var controlName = fieldName;

                var peoplePickerDiv = $("[id$='ClientPeoplePicker'][title='" + controlName + "']");

                //console.log("peoplePickerDiv",peoplePickerDiv[0] );

                var peoplePickerEditor = peoplePickerDiv.find("[title='" + controlName + "']");

                // console.log("peoplePickerEditor ",peoplePickerEditor );
                var spPeoplePicker = SPClientPeoplePicker.SPClientPeoplePickerDict[peoplePickerDiv[0].id];

                if (spPeoplePicker) {
                    var ResolvedUsers = $(document.getElementById(spPeoplePicker.ResolvedListElementId)).find("span[class='sp-peoplepicker-userSpan']");

                   // console.log(ResolvedUsers);

                    $(ResolvedUsers).each(function (index) {

                        spPeoplePicker.DeleteProcessedUser(this);

                    });
                }

        }, 20);
    }, 'clientpeoplepicker.js');



}
/**
 * checks if a user is in a group
 * @param _context
 * @param _web
 * @param _groupName
 * @param _userId
 * @param onSuccess
 * @param onFailure
 */
isUserInGroup = function(_context, _web, _groupName, _userId,onSuccess,onFailure){
    var groups = web.get_siteGroups();
    _context.load(groups);
    _context.executeQueryAsync(function() {
        var group = groups.getByName(_groupName);
        _context.load(group);
        _context.executeQueryAsync(function() {
            var users = group.get_users();
            context.load(users);
            context.executeQueryAsync(function() {
                var checkUser = users.getById(_userId);
                context.load(checkUser);
                context.executeQueryAsync(onSuccess,onFailure);
            }, function() { throw 'Could Not Retrieve Any User For Group ' + _groupName});
        }, function() { throw 'Could Not Find Group ' + _groupName;});
    }, function() { throw 'Could Not Retrive Group List';});
}

/**
 * get field names from list
 * VERY IMPORTANT
 */
function retrieveFieldsOfListView(){

    var view = list.get_views().getByTitle('All Items');
    var listFields = view.get_viewFields();
    context.load(listFields);
    context.executeQueryAsync(printFieldNames,onError);


    function printFieldNames() {
        var e = listFields.getEnumerator();
        while (e.moveNext()) {
            var fieldName = e.get_current();
            console.log(fieldName);
        }
    }

    function onError(sender,args)
    {
        console.log(args.get_message());
    }

}
/**
 * retrieve Fields Of ListView
 * @param listName
 */
function retrieveFieldsOfListView(listName){

    var view = list.get_views().getByTitle(listName);
    var listFields = view.get_viewFields();
    context.load(listFields);
    context.executeQueryAsync(printFieldNames,onError);


    function printFieldNames() {
        var e = listFields.getEnumerator();
        while (e.moveNext()) {
            var fieldName = e.get_current();
            console.log(fieldName);
        }
    }

    function onError(sender,args)
    {
        console.log(args.get_message());
    }

}
/**
 * formatDate to yyyy-mm-dd
 * @param date {string}
 * @returns {string}
 */
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
/**
 * wait function
 * @param ms {number}
 */
function wait(ms){
    var start = new Date().getTime();
    var end = start;
    while(end < start + ms) {
        end = new Date().getTime();
    }
}

/**
 * hide FieldT itles by name
 * @param element
 * @param fieldNames
 */
function hideFieldTitles(element, fieldNames) {
    //var test = ['Manger Comment','Reference Number','Override Number of Days','Reason for Override','Doctors Name','Practice Number','Hr Comments'];
    var listOfElements = document.getElementsByTagName(element);

    for (var i = 0; i < listOfElements.length; i++) {
        fieldNames.forEach(function (item) {
            if(listOfElements[i].innerHTML.indexOf(item)!== -1){
                listOfElements[i].style.display = 'none';
                console.log('true');
            }
        })


    }

    //console.log('hideElements',listOfElements);
    //console.log('hideElements',test);
}
/**
 * show Field Titles by names
 * @param element {string}
 * @param fieldNames {array}
 */
function showFieldTitles(element, fieldNames) {
    var test = ['Manger Comment','Reference Number','Override Number of Days','Reason for Override','Doctors Name','Practice Number','Hr Comments'];
    var listOfElements = document.getElementsByTagName(element);

    for (var i = 0; i < listOfElements.length; i++) {
        fieldNames.forEach(function (item) {
            if(listOfElements[i].innerHTML.indexOf(item)!== -1){
                listOfElements[i].style.display = 'block';
                console.log('true');
            }
        })


    }

    //console.log('showElements',listOfElements);
    //console.log('hideElements',test);
}
/**
 * get Current Url
 */
function getCurrentUrl() {
    var url = unescape(location);
    return url;
}
function getQueryString() {
    var assoc = new Array();
    var queryString = unescape(location.search.substring(1));
    var keyValues = queryString.split('&');
    console.log(keyValues);
    for (var i in keyValues) {
        var key = keyValues[i].toString().split('=');
        assoc[key[0]] = key[1];
    }
    return assoc;
}

