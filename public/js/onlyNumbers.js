function validate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);

    var regex = /[0-9]/;

    if(!regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) 
        theEvent.preventDefault();
    } 
  }

  function pressEnter(evt){    
    if(evt.which==13)
      addDiv();
  }

  function addDiv(){
    var rowDiv = document.createElement("div");
    rowDiv.className= 'row justify-content-center m-2';
    
    var newDiv = document.createElement("div");
    newDiv.className= 'input-group w-25';   

    var input=document.createElement("input");
    input.placeholder='Wprowadź liczbę';
    input.type='text';
    input.className='form-control text-center';
    input.autocomplete='off';
    input.name= 'numbers[]';
    input.required=true;
    input.addEventListener("keypress",validate);
    input.addEventListener("keydown", pressEnter);

    rowDiv.appendChild(newDiv);
    newDiv.appendChild(input);
    var parentDiv = document.getElementById("parent");
    parentDiv.appendChild(rowDiv);
    input.focus();
  }