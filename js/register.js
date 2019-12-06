/*

      DJD's login form
      Author: Daniel J Dunevant
      Date: 6/30/16

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

function validatePasswords(){
	var errorDiv = document.querySelector("#errorPass");
	var pass1Element = document.getElementById("pass1");
	var pass2Element = document.getElementById("pass2");
	var passwordMismatch = false;
  var passwordShort = false;
  var passwordNoSpecialChar = false;
  var passwordEmpty=false;
  var fieldsetValidity = true;
  var letters = /^[0-9a-zA-Z]+$/;
	var invColor = "rgb(255,233,233)";
  var mismatchErrorStr = "Passwords entered do not match.";
  var shortErrorStr = "Passwords must be at least 8 characters.";
  var specialCharErrorStr = "Passwords must contain at least 2 special characters.";
  var emptyError ="No password inputed. Enter your password.";
	try{
		pass1Element.style.background = "";
		pass2Element.style.background = "";
		errorDiv.style.display = "none";
		if((pass1Element.value !== "" && pass2Element.value !== "")){
			if(pass1Element.value !== pass2Element.value){
        var fieldsetValidity = false;
				passwordMismatch = true;
			}
      if (pass1Element.value.length<8){
        passwordShort = true;
      }
      if(!(pass1Element.value.match(letters)||[]).length<2){
        passwordNoSpecialChar = true;
      }
		}
		if(pass1Element.value === "" && pass2Element.value === ""){
			passwordEmpty = true;
		}
    if(!fieldsetValidity){
      throw "Correct the following error(s): " + ternaryLine(passwordMismatch,mismatchErrorStr,"") + "  " + ternaryLine(passwordNoSpecialChar,specialCharErrorStr,"") + "  "+ ternaryLine(passwordShort,shortErrorStr,"" ) +"  "+ ternaryLine(passwordEmpty,emptyError,"") +" Reenter.";
    }

	}
	catch(msg){
		errorDiv.innerHTML = msg;
		errorDiv.style.display = "block";
		if(passwordMismatch){
			pass1Element.style.background = invColor;
			pass2Element.style.background - invColor;
		}else{
			if(pass1Element.value === ""){
				pass1Element.style.background = invColor;
			}
			if(pass2Element.value === ""){
				pass2Element.style.background = invColor;
			}
		}
		formValidity = false;
	}
}

function ternaryLine(condition,ifTrue,ifFalse){
  return (condition)?ifTrue:ifFalse;
}

function validateForm(evt){
	if(evt.preventDefault){
		evt.preventDefault();
	}else{
		evt.returnValue=false;
	}
	formValidity = true;
	validateEmail();
  validatePasswords();

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
