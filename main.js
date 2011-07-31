/**
 * Winner v1.1
 * Author: Chris Montgomery (chr.montgomery@gmail.com)
 */
var currentWinner = "";
var radioNum = 0;

isCookieEnabled = function() {
  var cookieEnabled = (navigator.cookieEnabled) ? true : false;
  //if not IE4+ nor NS6+
  if( typeof navigator.cookieEnabled == "undefined" && !cookieEnabled) {
    document.cookie = "testcookie";
    cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false;
  }
  return cookieEnabled;
};

setData = function(key,val) {
  var setSuccess = false;
  if (Modernizr.localstorage) {
    setSuccess = true;
    value = window.localStorage.setItem(key,val);
  } else if (isCookieEnabled()) {
    setSuccess = true;
    value = window.sessionStorage.createCookie(key,val,365);
  }
  return setSuccess;
};

getData = function(key) {
  var value = null;
  if (Modernizr.localstorage) {
    value = window.localStorage.getItem(key);
  } else if (isCookieEnabled()) {
    value = window.sessionStorage.readCookie(key);
  }
  return value;
};

getWinnerButtonHtml = function() {
  return "<input id=\"getWinnerButton\" type=\"button\" value=\"Get a winner!\" onclick=\"roll();\" />";
};

radioSelect = function(val) {
  document.getElementById("winnerButtonWrapper").innerHTML = getWinnerButtonHtml();
  document.getElementById(val).checked = true;
};

getRadioHtml = function(val) {
  radioNum++;
  return "<div class=\"radioWrapper\" onclick=\"radioSelect('r" + radioNum + "');\"><input type=\"radio\" id=\"r" + radioNum + "\" name=\"savedGroup\" value=\"" + val + "\">" + val + "</div>";
};

createGroup = function() {
  var grp = document.getElementById("grp").value;
  var items = document.getElementById("items").value;
  //TODO validate inputs
  
  var groups = getData("groups");
  
  if (groups) {
    groups = groups + "," + grp;
  } else {
    groups = grp;
    //also add the button now that there is at least 1 group
    document.getElementById("winnerButtonWrapper").innerHTML = getWinnerButtonHtml();
  }
  setData("groups",groups);
  setData(grp,items);
  
  var html = document.getElementById("savedGrps").innerHTML;
  html = html + getRadioHtml(grp);
  document.getElementById("savedGrps").innerHTML = html;
  
  //clear out data in form
  document.getElementById("grp").value = "";
  document.getElementById("items").value = "";
};

roll = function() {
  document.getElementById("winnerButtonWrapper").innerHTML = "<img id=\"loadingImg\" src=\"loading.gif\"/>";
  
  var grp = getSelectedSavedGroup();
  if (grp) {
    if (Modernizr.localstorage) {
      var items = getData(grp);
      var itemArr = items.split(" ");
      currentWinner = getRandomValue(itemArr);
    }
    setTimeout("displayWinner()", 1500);
  } else {
    //no group was selected before rolling
    document.getElementById("winnerButtonWrapper").innerHTML = "Select a group from above before attempting to get a winner!";
  }
};

displayWinner = function() {
  var winnerText = "<div>and the lucky winner is... <span id=\"winnerName\">" + currentWinner + "!</span></div>";
  winnerText += "<div>Don't like the result? <input type=\"button\" value=\"Try Again\" onclick=\"roll();\" /></div>";
  document.getElementById("winnerButtonWrapper").innerHTML = winnerText;
};

getSelectedSavedGroup = function() {
  var grps = document.getElementsByName("savedGroup");
  var el = null;
  for(var i = 0; i < grps.length; i++) {
    if(grps[i].checked) {
      el = grps[i];
      return el.value;
    }
  }
  return null;
};

getRandomValue = function(valArray) {
  if (typeof valArray === "object" && valArray instanceof Array) {
    if (valArray.length > 0) {
      //input was an array with at least one value
      var randomNum = Math.floor(Math.random() * valArray.length);
      return valArray[randomNum];
    }
  }
  return "";
};

//initialize page with previously stored groups
var groups = getData("groups");
if (groups) {
  var groupsArr = groups.split(",");
  var html = document.getElementById("savedGrps").innerHTML;
  for(var i = 0; i < groupsArr.length; i++) {
    html = html + getRadioHtml(groupsArr[i]);
  }
  document.getElementById("savedGrps").innerHTML = html;
} else {
  document.getElementById("winnerButtonWrapper").innerHTML = "No groups created yet. Create a group above before finding your lucky winner.";
}