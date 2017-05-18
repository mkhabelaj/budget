var context = SP.ClientContext.get_current();
var web = context.get_web();
var list = web.get_lists().getByTitle('Leave Request');
/**
 * get current list url
 * for redirection purposes
 * @type {T}
 */
var rediectUrl = getCurrentUrl().split("/Disp").shift();
var redirect = false;
var managerGroup="Test Manager Leave Approver";
var hrGroup = "Test HR Leave Approvers";


$(document).ready(function () {
    //retrieveFieldsOfListView();
    /**
     * hide close button
     */
    $("#ctl00_ctl26_g_612d6af4_50f9_4d6e_baa3_197cbad83a26_ctl00_toolBarTbl").children(":first").children(":first").children(":last").hide();
    /**
     * creating structure for new close, and manager approve buttons
     */
    $('#ctl00_ctl26_g_612d6af4_50f9_4d6e_baa3_197cbad83a26_ctl00_toolBarTbl').children(":first").append('<tr ><td><table><tr class="aproval-buttons"></tr></table</td></tr>');
    

    /**
     * new close functionalty
     */
    $('.aproval-buttons').append('<td id="new-close"><input type="button" value="Close"></td>');
    $('#new-close').click(function () {
        window.location.replace(rediectUrl);
    });
    ExecuteOrDelayUntilScriptLoaded(myFunctionToBeExecuted, "sp.js");


});
function myFunctionToBeExecuted(){
    SP.SOD.executeFunc('sp.js', 'SP.ClientContext', myFunction);
};

var onGetUserNameFail= function (str){ console.log("Failed " + str); };

function myFunction(){

    if (context == null){
        alert("Context Object is Null!");
    }

    context.load(web);
    context.executeQueryAsync(function() {

        /**
         * loading current user information
         */
        var user = web.get_currentUser();
        context.load(user);
        context.executeQueryAsync(function() {
                console.log("user", user.get_title());

                console.log("user context", user.get_context());

                var groups = web.get_siteGroups();
                context.load(groups);
                context.executeQueryAsync(function() {
                    /**
                     * check if a user is apart of a group and hide of show infomation respectively
                     */
                    isUserInGroup(context,web,managerGroup,user.get_id(),showManagerButtons ,failure);
                    isUserInGroup(context,web,hrGroup,user.get_id(),showHRButton,failure);
                },onGetUserNameFail);
            }
            ,onGetUserNameFail);

    },onGetUserNameFail);

}

//Shows Hr button if not in hr group
showHRButton = function(){
    //$('#\\{9E25AAB9\\-5F73\\-4D5E\\-9203\\-4C1192FAF4DA\\}\\-Large').show();
    // $('.aproval-buttons').append('<td id="hr-process"><input type="button" value="Process"></td>');
    //
    // $('#hr-process').click(function(){
    //     redirect = true;
    //     updateListItem('Hr','proccessed');
    //     //alert("test");
    // });
    // console.log("showHRButton");
}

//Shows Manager buttons if not in hr group
showManagerButtons = function(){
    /**
     * get users manager
     */

    //TODO find cleaner way
   var usersManager = $('[name="SPBookmark_Manager"]').parent().parent().siblings()[0].children[0].children[0].children[0].children[2].children[0].children[0].children[0].children[0].children[1].innerHTML;
    console.log("usersManager ",  usersManager );

    /**
     * get user
     */
    var user = web.get_currentUser();
    context.load(user);
    context.executeQueryAsync(function(){
        console.log(user.get_title());
        currentUserName = user.get_title();

        // console.log("usersManager ",  usersManager.replace(/\s/g, '').length );
        // console.log("currentUserName ", currentUserName.replace(/\s/g, '').length  );
        // console.log(usersManager);
        // console.log(currentUserName);
        /**
         * check if user and manager are equal
         * if they are show the nessaty buttons
         */
        if(usersManager.replace(/\s/g, '') == currentUserName.replace(/\s/g, '')){
            console.log("managers match");
            //Show manager approve button
            $('.aproval-buttons').append('<td id="manager-approve"><input type="button" value="Approve"></td>');
            $('.aproval-buttons').append('<td id="manager-decline"><input type="button" value="Decline"></td>');

            /**
             * add click event into manager aprove
             */
            $('#manager-approve').click(function(){
                redirect = true;
                updateListItem('Manager_x0020_Approval','approved');
            });
            /**
             * add click event into manager decline
             */
            $('#manager-decline').click(function(){
                var declinedReason = "";
                while (declinedReason == ""){
                    declinedReason = prompt("Please enter a Reason:", "");
                }
                if(declinedReason){
                    redirect = false;
                    updateListItem('Manger_x0020_Comment',declinedReason);

                    setTimeout(function(){
                        redirect = true;
                        updateListItem('Manager_x0020_Approval','declined');
                    }, 2000);


                    //alert(declinedReason);
                }
            });
        }else{
            console.log('you dont have permissions');
        }
    },function() { throw 'Could Not find current user';});

    console.log("showManagerButtons");
}




//Generic failure function,
failure = function(){
    console.log("failure ");
    return false;}

//checks if the current user is apart of a spercific group
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

//sets the current user name;
function setCurrentUserName(_context, _web){
    var user = _web.get_currentUser();
    _context.load(user);
    _context.executeQueryAsync(function(){
        console.log(user.get_title());
        currentUserName = user.get_title();
    },function() { throw 'Could Not find current user';});
}
//sets the current Manager name;
function setManagerUserName(_context, _web){
    var user = _web.get_currentUser();
    _context.load(user);
    _context.executeQueryAsync(function(){
        var userInfoList = _web.get_siteUserInfoList();
        _context.load(userInfoList);

        _context.executeQueryAsync(function() {

            var userProfile = userInfoList.getItemById(user.get_id());
            _context.load(userProfile);
            _context.executeQueryAsync(function() {

                $("#Manager").val(userProfile.get_item('Manager'));
                console.log("user profile",userProfile);
                console.log("manager",userProfile.get_item('Manager'));
                currentManagerName =userProfile.get_item('Manager');
            }, function() { throw 'Could Not find users manager';});
        }, function() { throw 'Could Not find users manager';});
    },function() { throw 'Could Not find current user';});
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
/**
 * updates the list items
 * @param field
 * @param value
 */
function updateListItem(field, value) {

    var oListItem = list.getItemById(getQueryString()["ID"]);

    oListItem.set_item(field, value);

    oListItem.update();

    context.executeQueryAsync(Function.createDelegate(this, this.onQuerySucceeded), Function.createDelegate(this, this.onQueryFailed));
}

function onQuerySucceeded() {
    console.log('Item updated!');
    if(redirect){
        window.location.replace(rediectUrl);
    }
}

function onQueryFailed(sender, args) {

    alert('Request failed. ' + args.get_message() + '\n' + args.get_stackTrace());
    console.log('Request failed. ' + args.get_message() + '\n' + args.get_stackTrace());
}

//get field names from list
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


