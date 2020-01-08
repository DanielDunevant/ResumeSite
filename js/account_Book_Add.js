/*

      DJD's login form
      Author: Daniel J Dunevant
      Date: 12/21/19

      Filename: account_Book_Add.php


  */
"use strict";
var formValidity = true;
var book = {};
var currentlyEdit=-1;
var priorEdited;
if(window.addEventListener){
  window.addEventListener("load", setupPage,false);
}else if(window.attachEvent){
  window.attach("onload",setupPage);
}
function setupPage(){
  removeSelectDefaults();
  createEventListeners();
  tableAlignment();
}

function tableAlignment(){
  var tableHeaders = document.querySelectorAll("table th");
  var tableData = document.querySelectorAll("table td");
  var numOfColumns = tableHeaders.length;
  var columnWidths = (1/numOfColumns)*100;
  for(var i = 0;i<tableHeaders.length;i++){
    console.log("changed heading Width: "+ columnWidths.toString()+"%");
    tableHeaders[i].style.width = columnWidths.toString()+"%";

  }
  for(var i = 0;i<tableData.length;i++){

    tableData[i].style.width = columnWidths.toString()+"%";
  }
}

function createEventListeners(){
  var form = document.getElementsByTagName("form")[0];
  if(form.addEventListener){
    form.addEventListener("submit",validateForm,false);
  }else if(form.attachEvent){
    form.attachEvent("onsubmit",validateForm);
  }
  var addBookButton = document.getElementById("addBookBtn");
  if(addBookButton.addEventListener){
    addBookButton.addEventListener("click",addBook,false);
  }else if(addBookButton.attachEvent){
    addBookButton.attachEvent("onclick",addBook);
  }
//Gathers all inputs within table
//checks whether they've been changed
//If changed then leave give them changed class
//If not make no color change (Edit Toggle will remove)
  var tableInputs = document.querySelectorAll("td input");
  if(tableInputs[0].addEventListener){
    for(var i =0;i< tableInputs.length;i++){
      tableInputs[i].addEventListener("change",editTable,false);
    }
  }else if(tableInputs[0].attachEvent){
    for(var i =0;i< tableInputs.length;i++){
      tableInputs[i].attachEvent("onchange",editTable);
    }
  }

  //if a delete text is clicked then
  //its parentNode element will be highlighted in red and text will change also as it is marked for deletion
  var deleteBtn = document.getElementsByClassName("delete");
  if(deleteBtn[0].addEventListener){
    for(var i =0;i< deleteBtn.length;i++){
      deleteBtn[i].addEventListener("click",markForDeletion,false);
    }
  }else if(deleteBtns[0].attachEvent){
    for(var i =0;i< deleteBtn.length;i++){
      deleteBtn[i].attachEvent("onclick",markForDeletion);
    }
  }
  /*var records = document.getElementsByTagName("tr");
  if(records[0].addEventListener){
    for(var i =0;i< records.length;i++){
      console.log("how many records? :"+records.length);
      if(i!=0){
      var recordID = records[i].id;
      records[i].addEventListener("click",function(){ console.log(recordID); editToggle(recordID); });
      recordID=null;
      }
  }
  }else if(records[0].attachEvent){
      for(var i =0;i< records.length;i++){
        if(i!=0){
        recordID = records[i].id;
        records[i].attachEvent("onclick",function(){ editToggle(recordID); });
        recordID=null;
        }
      }
    }*/
}

function markForDeletion(evt){
  var deleteBtn = evt.currentTarget;
  var tableRow = deleteBtn.parentNode.parentNode;
  tableRow.className = "deleteRecord";

}

function editTable(evt){
  var inputElement = evt.currentTarget;
  var tableRow = inputElement.parentNode.parentNode;
  var paragraph = inputElement.previousSibling;
  paragraph.innerHTML = inputElement.value;
  tableRow.className = "editedAndChanged";
}

function addBook (){
  validateBookName();
  validateBookAuthor();
  validateBookType();
  validateBookStatus();
  var newRow = document.createElement("TR");
  newRow.className = "addRecord";
  newRow.innerHTML = "<td><a class='delete' class='button'>Delete</a></td><td><a class='edit' class='button'>Edit</a></td><td><p>"+book.name+"</p><input value ='"+book.name+"' style = 'display:none'></td><td><p>"+book.author+"</p><input value ='"+book.author+"' style = 'display:none'></td><td><p>"+book.type+"</p><input value ='"+book.type+"' style = 'display:none'></td>  <td><p>"+book.status+"</p><input value ='"+book.status+"' style = 'display:none'></td>";
  var table = document.getElementsByTagName("TABLE");
  table[1].insertBefore(newRow,table[1].childNodes[0]);
}

function editToggle (rowID){
  //selected values
  priorEdited=currentlyEdit;
  currentlyEdit=rowID;
  var recordId = "book_"+rowID;
  var record = document.getElementById("book_"+rowID);
  var paraData = document.querySelectorAll("#book_"+rowID+" td p");
  var inputData = document.querySelectorAll("#book_"+rowID+" td input");
  var paraDataPrior = document.querySelectorAll("#book_"+priorEdited+" td p");
  var inputDataPrior = document.querySelectorAll("#book_"+priorEdited+" td input");

  if(record.className===""){
    record.className="edited";
  }
  var records = document.getElementsByTagName("tr");
  for( var i = 0;i<records.length;i++){
    //Will now remove class if
    //it is clicking on the same as the prior records
    //or the class name is  equal to editedAndChanged (Meaning: if the  record has been edited the class won't be remove)
    if (records[i].id!= recordId && records[i].className!="editedAndChanged" && records[i].className!="deleteRecord" && records[i].className!="addRecord"){
      records[i].className = "";
    }
  }

 //Reveal inputs and remove paras
  for(var i = 0;i<inputData.length;i++){
    inputData[i].style.display = "block";
    paraData[i].style.display ="none";
  }

  //Remove input of previous clicked and reveal paras
   for(var i =0;i<inputDataPrior.length;i++){
     if(rowID!=priorEdited){
      inputDataPrior[i].style.display = "none";
      paraDataPrior[i].style.display = "block";
      }
  }
}

function removeSelectDefaults()
{
      var emptyBoxes = document.getElementsByTagName("select");
      for(var i = 0;i < emptyBoxes.length;i++){
	emptyBoxes[i].selectedIndex=-1;
      }
}

function validateBookName(){
  var bookName = document.getElementById("bookName");
  var errorDiv = document.getElementById("error_BookName");
  var fieldsetValidity = true;
  try{
    if(bookName.value ===""){
      throw "Enter the book title. None Entered."
    }
    book.name = bookName.value;
  }
  catch(msg){
    errorDiv.style.display = "block";
    bookName.style.background = "rgb(255,233,233)";
		errorDiv.innerHTML = msg;
		fieldsetValidity = false;
  }
}

function validateBookAuthor(){
  var bookAuthor = document.getElementById("author");
  var errorDiv = document.getElementById("error_author");
  var fieldsetValidity = true;
  try{
    if(bookAuthor.value ===""){
      throw "Enter the author. None Entered.";
    }
    //validate *at least 8 characters
    //         *Consists of at least 2 words (string x amount of space then another string)
    //         *if not 8 chars must follow prior rule however must be
    //          one char followed by a period a space. In other words
    //          it must be in initial form (D.J.D. , G.E.C., B.O.C.)
    if(bookAuthor.value<8){
      throw "Must enter at least 8 characters. ";
    }
    book.author = bookAuthor.value;
  }
  catch(msg){
    errorDiv.style.display = "block";
    bookAuthor.style.background = "rgb(255,233,233)";
		errorDiv.innerHTML = msg;
		fieldsetValidity = false;
  }
}

function validateBookType(){
  var bookType = document.getElementById("bookType");
  var errorDiv = document.getElementById("error_Book");
  var fieldsetValidity = true;
  try{
    if(bookType.value ==="-1"){
      throw "Select a book type. None selected.";
    }
    book.type = bookType.value;
  }
  catch(msg){
    errorDiv.style.display = "block";
    bookType.style.background = "rgb(255,233,233)";
		errorDiv.innerHTML = msg;
		fieldsetValidity = false;
  }
}

function validateBookStatus(){
  var bookStatus = document.getElementById("status");
  var errorDiv = document.getElementById("error_status");
  var fieldsetValidity = true;
  try{
    if(bookStatus.value ==="-1"){
      throw "Select a book type. None selected.";
    }
    book.status = bookStatus.value;
  }
  catch(msg){
    errorDiv.style.display = "block";
    bookStatus.style.background = "rgb(255,233,233)";
		errorDiv.innerHTML = msg;
		fieldsetValidity = false;
  }
}

function validateForm(evt){
	if(evt.preventDefault){
		evt.preventDefault();
	}else{
		evt.returnValue=false;
	}
	formValidity = true;
	validateBookName();
  validateBookAuthor();
  validateBookType();
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
