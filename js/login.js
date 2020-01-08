/*

      DJD's login form
      Author: Daniel J Dunevant
      Date: 12/6/19

      Filename: login.js


  */
"use strict";
var formValidity = true;

if(window.addEventListener){
	window.addEventListener("load", setupPage,false);
}else if(window.attachEvent){
	window.attach("onload",setupPage);
}

function setupPage(){
  createEventListeners();
}

function createEventListeners(){
	var form = document.getElementsByTagName("form")[0];
  if(form.addEventListener){
    form.addEventListener("submit",validateForm,false);
  }else if(form.attachEvent){
    form.attachEvent("onsubmit",validateForm);
  }
}

function validateEmail(){
  var errorDiv = document.querySelector("#errorEmail");
  var fieldsetValidity = true;
  var email = document.getElementById("email");
  try{
    email.style.background = "";
    errorDiv.style.display = "none";
    var countAt = (email.value.match(/@/g)||[]).length;
    //var countDot = email.value.split(".").length - 1;
    if(email.value===""){
      throw "Nothing was entered. Enter the email you used to set up your account.";
    }else{
      if(countAt == 0 || countAt >1 ){
        fieldsetValidity = false;
      }else{
        var emailAtSplit =   email.value.split("@");
        if( emailAtSplit[0]=="" ){
          fieldsetValidity = false;
        }
        var emailDotSplit = emailAtSplit[1].split(".");
        if (emailDotSplit[0].length <1 || emailDotSplit[1].length <1) {
          fieldsetValidity=false;
        }
        var countDot = emailAtSplit[1].split(".");
        if(countDot == 0 || countDot >1 ){
          fieldsetValidity = false;
        }
        //FOR TESTING only
      }
      if(!fieldsetValidity){
        throw "Invalid email. Reenter.";
      }
  }
}
  catch(msg){
    errorDiv.style.display = "block";
    email.style.background = "rgb(255,233,233)";
		errorDiv.innerHTML = msg;
		formValidity = false;
  }
}

function validatePassword(){
  var errorDiv = document.querySelector("#errorPass");
  var pass = document.getElementById("password");
  try{
    pass.style.background = "";
    errorDiv.style.display = "none";
    if(pass.value.length==0){
      throw "Invalid password. Reenter.";
    }
  }
  catch(msg){
    errorDiv.style.display = "block";
    pass.style.background = "rgb(255,233,233)";
		errorDiv.innerHTML = msg;
		formValidity = false;
  }
}


function validateForm(evt){
	if(evt.preventDefault){
		evt.preventDefault();
	}else{
		evt.returnValue=false;
	}
	formValidity = true;
	validateEmail();
  validatePassword();
	if(formValidity ===true){
		document.getElementById("errorText").innerHTML = "";
		document.getElementById("errorText").style.display ="none";
		document.getElementsByTagName("form")[0].submit();
	}else{
		document.getElementById("errorText").innerHTML ="Fix the indicated problems and then resubmit.";
		document.getElementById("errorText").style.display = "block";
		scroll(0,0);
	}
}
