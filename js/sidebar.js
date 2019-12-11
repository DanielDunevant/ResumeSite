/*
      DJD's Sidebar
      Author: Daniel J Dunevant
      Date: 11/26/19
      Filename: view/sidebar.php
*/
"use strict";
var titleTextArrayElement=0;
var titleTextElement=0;
var titleTextWritten=false;
var titleTextCursor=false;
var titleTextInterval;
var titleTextCursorInterval;
function menuAni(){
  var menu = document.getElementById("menu");
  menu.style.display = "block";
  if(menu.className ==="center sectShadow menuDown"){
    menu.className = "center sectShadow menuUp";
  }else{
    menu.className = "center sectShadow menuDown";
  }
}

function hideMe(){
  // Move these 2 below Y
  var facebook_1 = document.getElementById("facebook_1");
  //Clicked object Z
  var rss_1 = document.getElementById("rss_1");
  var gitHub_1 = document.getElementById("gitHub_1");
  // Move these 2 below Y
  var facebook_2 = document.getElementById("facebook_2");
  //Clicked object Z
  var rss_2 = document.getElementById("rss_2");
  var gitHub_2 = document.getElementById("gitHub_2");
  //Hide this X
  var sidebar = document.getElementById("recentSidebar");
  if (sidebar.style.display === "none") {
   // x.setAttribute("id","menu");
    sidebar.style.display = "block";
    facebook_1.style.display = "none";
    rss_1.style.display = "none";
    gitHub_1.style.display = "none";
    facebook_2.style.display = "block";
    rss_2.style.display = "block";
    gitHub_2.style.display = "block";
  } else {
   // x.setAttribute("id","menuAni");
    sidebar.style.display = "none";
    facebook_1.style.display = "block";
    rss_1.style.display = "block";
    gitHub_1.style.display = "block";
    facebook_2.style.display = "none";
    rss_2.style.display = "none";
    gitHub_2.style.display = "none";
  }
}

function updateText(){
  var textArray = ["is cool","is always under-construction","eats doughnuts with hot-sauce"];
  var dotIO = document.getElementById("title_DotIO");
  var trimString;
  if(textArray[titleTextArrayElement].length===titleTextElement){
    titleTextWritten =true;
  }
  if(titleTextWritten===false){
    dotIO.innerHTML += textArray[titleTextArrayElement][titleTextElement];
    titleTextElement+=1;
  }else{
    trimString =dotIO.innerHTML;
    dotIO.innerHTML=trimString.substring(0, trimString.length - 1);
    titleTextElement-=1;
  }
  if(titleTextWritten && dotIO.innerHTML ==".io&nbsp;"){
    titleTextArrayElement+=1;
    titleTextWritten=false;
    titleTextElement=0;
  }
  if( titleTextArrayElement=== textArray.length){
    titleTextArrayElement=0;
  }
}

function cursorFlash(){
  var titleTextCursorElement = document.getElementById("title_Cursor");
  if(titleTextCursor){
    titleTextCursorElement.innerHTML = "";
    titleTextCursor =false;
  }else{
    titleTextCursorElement.innerHTML = "|";
    titleTextCursor =true;
  }
}

function titleTextChanger(){
  titleTextInterval=setInterval(updateText,100);
  titleTextCursorInterval=setInterval(cursorFlash,1000);
  console.log("after TxtChgr");

}

if(window.addEventListener){
  window.addEventListener("load", setupPage,false);
}else if(window.attachEvent){
  window.attach("onload",setupPage);
}
function setupPage(){
  createEventListeners();
  console.log("before TxtChgr");
  titleTextChanger();

}
function createEventListeners(){
  var menuClick_1 = document.getElementById("menuClick1");
  if(menuClick_1.addEventListener){
    menuClick_1.addEventListener("click",menuAni,false);
  }else if(menuClick_1.attachEvent){
    menuClick_1.attachEvent("onclick",menuAni);
  }
  var menuClick_2 = document.getElementById("menuClick2");
  if(menuClick_2.addEventListener){
    menuClick_2.addEventListener("click",menuAni,false);
  }else if(menuClick_2.attachEvent){
    menuClick_2.attachEvent("onclick",menuAni);
  }
  var rssButton_1 = document.getElementById("rss_1");
  if(rssButton_1.addEventListener){
    rssButton_1.addEventListener("click",hideMe,false);
  }else if(rssButton_1.attachEvent){
    rssButton_1.attachEvent("onclick",hideMe);
  }
  var rssButton_2 = document.getElementById("rss_2");
  if(rssButton_2.addEventListener){
    rssButton_2.addEventListener("click",hideMe,false);
  }else if(rssButton_2.attachEvent){
    rssButton_2.addEventListener("onclick",hideMe,false);
  }
}
