var context = SP.ClientContext.get_current();
var web = context.get_web();
//var holidays = ["2017-05-15","2017-05-11","2017-05-12","2017-05-14"];
var holidays = [];
var list = web.get_lists().getByTitle('holidays');
var test = "klkl";
var isHalfDay = true;

/**
 * setting reusable variables
 */
var firstDayOfLeaveField, lastDayOfLeaveField,
    numberoFfDays, annualLeaveBalance, leaveReason,
    LeaveType,employeeName,otherUserId,
    managerApproval,mangerComment,manager,
    hrComments,practiceNumber,doctorsName,
    referenceNumber,reasonForOverride,
    sickNote,overrideNumberofDays, fieldTitles,halfDay;
$(document).ready(function () {


    /**
     * this function gets all the event public holiday dates
     */
    getItemsFromView('holidays', 'All Events').then(getItemsFromViewSuccess,getItemsFromViewFailure);

    /**
     * this section gets all the input fields by title
     * and returns a live reusable DOM element
     */
    firstDayOfLeaveField = getInputByTile('input','First Day of Leave');
    lastDayOfLeaveField = getInputByTile('input','Last Day of leave');
    numberoFfDays = getInputByTile('input','Number of Days');
    annualLeaveBalance = getInputByTile('input','Annual Leave Balance');
    leaveReason = getInputByTile('input','Leave Reason');
    LeaveType = getInputByTile('input','Leave Type');
    managerApproval = getInputByTile('select','Manager Approval');
    reasonForOverride = getInputByTile('textarea','Reason for Override');
    referenceNumber = getInputByTile('textarea','Reference Number');
    doctorsName = getInputByTile('input','Doctors Name');
    sickNote = getInputByTile('input','Sick Note');
    halfDay = getInputByTile('input','Half Day');
    overrideNumberofDays = getInputByTile('input','Override Number of Days');
    practiceNumber = getInputByTile('input','Practice Number');
    hrComments = getInputByTile('textarea','Hr Comments');
    mangerComment = getInputByTile('textarea','Manger Comment');
    /**
     * this is a list of input names that will be hidden
     * @type {[*]}
     */
    fieldTitles = ['Manger Comment','Reference Number','Override Number of Days','Reason for Override','Doctors Name','Practice Number','Hr Comments','Sick Note'];

    /**
     * this is the id of the employee name fiels
     * @type {string}
     */
    employeeName = '#Employee_x0020_Name_4ac7109d-20b1-424e-8b39-0b137e14572f_\\$ClientPeoplePicker_HiddenInput';

    /**
     * this is the id of the manager field
     * @type {string}
     */
    manager = '#Manager_36c13060-1962-4431-b731-f1883534b5c6_\\$ClientPeoplePicker_HiddenInput';


    /**
     * we disable and hide all the fields that usere should not edit
     */
    managerApproval.attr('disabled', true);
    mangerComment.hide();
    numberoFfDays.attr("disabled",true);
    sickNote.hide();
	hideHRFields();

    /**
     * setting datapicker options
     */
    $.datepicker.setDefaults({
        //showOn: "both",
        //buttonImageOnly: true,
        //buttonImage: "calendar.gif",
        //buttonText: "Calendar"
    });


    $( function() {
        //setting date picker defaults
        firstDayOfLeaveField.datepicker();
        firstDayOfLeaveField.datepicker('setDate', new Date());
        firstDayOfLeaveField.datepicker("option", "dateFormat", 'yy-mm-dd');
        lastDayOfLeaveField.datepicker();
        lastDayOfLeaveField.datepicker('setDate',new Date());
        lastDayOfLeaveField.datepicker("option", "dateFormat", 'yy-mm-dd');
    });



});

/**
 * set number of leave days field
 */
function setLeaveDaysField(){
    /**
     * if the half day field is set then
     * then we hide the last day of leave, and set
     * the hidden last day of leave to equate the first day of leave
     * and we set the number of leave day to 0.5
     */
    if(isHalfDay) {
        if (firstDayOfLeaveField.val() && lastDayOfLeaveField.val()) {
            console.log("both are set");
            var total = numberOfLeaveDays(holidays, firstDayOfLeaveField.val(), lastDayOfLeaveField.val());
            numberoFfDays.val(total)
        }
    }else{
        lastDayOfLeaveField.datepicker('setDate',new Date(firstDayOfLeaveField.val()));
        var total = numberOfLeaveDays(holidays, firstDayOfLeaveField.val(), lastDayOfLeaveField.val());
        console.log('total ',total)
        if(total > 0){
            numberoFfDays.val(0.5);
            var convertedValue = numberoFfDays.val().replace('.',',');
            numberoFfDays.val(convertedValue)
            console.log("testing 87",numberoFfDays.val());
        }else {
            numberoFfDays.val(0)
        }

        console.log("lastDayOfLeaveField half ",lastDayOfLeaveField.val());
    }
}

/**
 * This section sets the manager field according to the user ID
 * @param userID
 * @param fieldName
 * @param disabled
 * @param hideImage
 */
function setMangerPeopleField(userID,fieldName,disabled,hideImage)
{
    var userInfoList = web.get_siteUserInfoList();
    var user = web.getUserById(userID);
    context.load(user);
    context.executeQueryAsync(function()
    {
        console.log('gettin user success');
        var userProfile = userInfoList.getItemById(user.get_id());
        console.log(user.get_title());
        context.load(userProfile);
        context.executeQueryAsync(function(){
            console.log('success loading user profile',userProfile);
            
            var currentManagerName='';
            if( userProfile.get_item('Manager') != null){
            	currentManagerName = userProfile.get_item('Manager').$2e_1;
	            SetAndResolvePeoplePicker(fieldName,currentManagerName,disabled,hideImage);
	            console.log(currentManagerName);
            }else{
                disablePeoplePicker("Manager");
            	alert("Your current manager is not set please contact the CRM Team");
            }
        },function(){throw 'failure loading user profile';});
    },function(){	throw 'failure to get other user';});

}

//
/**
 * Shows Manager buttons if in manager group
 */
showManagerButtons = function(){
    //Show HR approve button
    var user = web.get_currentUser();
    context.load(user);
    context.executeQueryAsync(function(){
        var userInfoList = web.get_siteUserInfoList();
        var currentUserName = user.get_title();
        context.load(userInfoList);
        context.executeQueryAsync(function() {
            var userProfile = userInfoList.getItemById(user.get_id());
            context.load(userProfile);
            context.executeQueryAsync(function() {
                /**
                 * check if current mangager and user are equal
                 * if the manager and the user are equal then the
                 * appropriate manager related fields will be showw
                 */
                var currentManagerName = JSON.parse( $(manager).val())[0].DisplayText;
                if(currentManagerName.replace(/\s/g, '') == currentUserName.replace(/\s/g, '')){
                    console.log("managers match");
                    managerApproval.attr('disabled', false);
                    mangerComment.show();
                }else{
                    managerApproval.attr('disabled', true);
                    mangerComment.hide();
                    console.log('you dont have permissions');
                }

               // console.log("currentManager ", currentManager)
            }, function() { throw 'Could Not find users manager';});
        }, function() { throw 'Could Not find users manager';});
    },function() { throw 'Could Not find current user';});


    console.log("showManagerButtons");
}

/**
 * this section will hide the HR fields If the user is not in the Designated HR group
 */
hideHRFields = function(){
    overrideNumberofDays.hide();
    reasonForOverride.hide();
    referenceNumber.hide();
    doctorsName.hide();
    practiceNumber.hide();
    hrComments.hide();
    hideFieldTitles('h3',fieldTitles);
    //console.log("hideHRFields");
}

/**
 * This function allows us to get a specific list using a specific view
 * @param listTitle | string | name of the list
 * @param viewTitle| string | name of the view
 * @returns {*}
 */
function getItemsFromView(listTitle, viewTitle)
{
    var deferred = $.Deferred();
    var context = new SP.ClientContext.get_current();
    var list = context.get_web().get_lists().getByTitle(listTitle);
    var view = list.get_views().getByTitle(viewTitle);
    context.load(view);

    context.executeQueryAsync(
       function () {
           deferred.resolve(view,listTitle);
       },
        function(sender, args){
           deferred.reject(sender,args);
        }
    );
    return deferred.promise();
}
var getItemsFromViewSuccess = function (view,listTitle) {

    getItemsFromList(listTitle, "<View><Query>" + view.get_viewQuery() + "</Query></View>");
}
getItemsFromViewFailure = function (sender, args) {
    alert("error: " + args.get_message());
}

/**
 * gets all the list items from the holidays list
 * @param listTitle
 * @param queryText
 */
function getItemsFromList(listTitle, queryText)
{
    var context = new SP.ClientContext.get_current();
    var list = context.get_web().get_lists().getByTitle(listTitle);

    var query = new SP.CamlQuery();
    query.set_viewXml(queryText);

    var items = list.getItems(query);

    context.load(items);
    context.executeQueryAsync(
        function()
        {
            var listEnumerator = items.getEnumerator();
            var i = 0;
            while (listEnumerator.moveNext())
            {
                // console.log(1," ",listEnumerator.get_current().get_item("Title"));
                //console.log(1," ",listEnumerator.get_current().get_item("Start Time"));
                var EventDate = listEnumerator.get_current().get_item("EventDate");
                var Title = listEnumerator.get_current().get_item("Title");
                holidays.push( ''+formatDate(EventDate));
                console.log("i",formatDate(EventDate));
                console.log("holidays in while",holidays);
                i++;


                //context.load(currentInfo);
                //context.executeQueryAsync(function(){currentInfo.get_item("Start Time")},function(){});
            }
            //alert("items retrieved: " + i);
            console.log("holidays before main",holidays);
            /**
             * once all the holidays are store in the holiday array
             * we call Main which runs the rest of the script
             */
            main();
        },
        function(sender, args) {alert("error in inner request: " + args.get_message());}
    );

}

/**
 * the main section sets up the necessary field in the form
 * it adds the employee names, manager, date fields
 * this section also binds change events to the relevant fields
 */
function main() {
    setLeaveDaysField();
    firstDayOfLeaveField.change(setLeaveDaysField);
    lastDayOfLeaveField.change(setLeaveDaysField);

    /**
     * Set current employee
     */
        //get current user
    var user = web.get_currentUser();
    context.load(user);

    context.executeQueryAsync(function(){
        SetAndResolvePeoplePicker('Employee Name',user.get_title(),true,false);
        setMangerPeopleField(user.get_id(),'Manager',false,true);

        /**
         * check if a user is apart of a group
         */
        setTimeout(function () {
            isUserInGroup(context,web,"Test HR Leave Approvers",user.get_id(),function(){
            	console.log("Test HR Leave Approvers");
            },function () {
            	//hideHRFields();
            	throw 'does not belong to Test HR Leave Approvers';
            	
            });
            isUserInGroup(context,web,"Test Manager Leave Approver",user.get_id(),showManagerButtons ,function () {throw 'does not belong to Test Manager Leave Approver'});
        },1000);

    },function () {throw 'could not load user';});


    /**
     * set new manager on field change
     */
    $(employeeName).on('inputchange', function() {

        var val = $(employeeName).val();
        if(val !='[]'){
            var value = JSON.parse(val);
            if(value[0].Resolved){
                if(value[0].Key ){
                    console.log('value', value[0].Key);
                    console.log('value', value[0]);
                    GetUserIdFromUserName(value[0].Key);
                    console.log('otherUserId',otherUserId);

                    var otherUser = web.getUserById(otherUserId);
                    context.load(otherUser);

                    context.executeQueryAsync(function(){
                        //SetAndResolvePeoplePicker('Employee Name',user.get_title(),true,false);
                        clearPeoplePicker('Manager');
                        setMangerPeopleField(otherUserId,'Manager',false,true);
                    },function () {throw 'could not load user';});

                }

            }
        }


    });

    halfDay.change(function () {

        /**
         * if the half day field is set then
         * then we hide the last day of leave, and set
         * the hidden last day of leave to equate the first day of leeve
         * and we set the number of leave day to 0.5
         */
        if(isHalfDay){
            //do something
            lastDayOfLeaveField.hide();
            hideFieldTitles('h3',['Last Day of leave']);
            var total = numberOfLeaveDays(holidays, firstDayOfLeaveField.val(), firstDayOfLeaveField.val());
            console.log('total ',total)
            if(total > 0){
                numberoFfDays.val(0.5);
                var convertedValue = numberoFfDays.val().replace('.',',');
                numberoFfDays.val(convertedValue)
                console.log("testing 87",numberoFfDays.val());
            }else {
                numberoFfDays.val(0)
            }


            console.log("lastDayOfLeaveField half ",lastDayOfLeaveField.val());
            isHalfDay = false;

        }else{
            //do something
            lastDayOfLeaveField.show();

            var total = numberOfLeaveDays(holidays, firstDayOfLeaveField.val(), lastDayOfLeaveField.val());
            console.log('total ',total)
            numberoFfDays.val(total)
            showFieldTitles('h3',['Last Day of leave']);
            isHalfDay = true;
        }
    });



}





















