function validateTeam(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);

    var regex = /^[a-z0-9]+$/i;


    if(!regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault)
        theEvent.preventDefault();
    }
  }


  function addDivPlayer(evt){
    if(evt.which==13) {
       // var newDiv = document.createElement("div");

       // newDiv.className = 'form-group form-filed horizontal';

        var rowDiv = document.createElement("div");
        rowDiv.className= 'row justify-content-center m-2';


        var newDiv = document.createElement("div");
        newDiv.className= 'input-group w-50';

        var input = document.createElement("input");
        input.placeholder = 'Wprowadź gracza';
        input.className='form-control text-center';
        input.type = 'text';
        input.autocomplete = 'off';
        input.name = 'players[]';
        input.required = true;
        input.addEventListener("keypress", validateTeam);
        input.addEventListener("keydown", addDivPlayer);

        newDiv.appendChild(input);
        rowDiv.appendChild(newDiv);
        var parentDiv = document.getElementById("parentPlayers");
        parentDiv.appendChild(rowDiv);
        input.focus();
    }
  }

  function addDivTeam(evt){

          if(evt.which==13) {


             // var newDiv = document.createElement("div");
               //newDiv.className = 'form-group form-filed horizontal';

              var rowDiv = document.createElement("div");
              rowDiv.className= 'row justify-content-center m-2';

              var newDiv = document.createElement("div");
              newDiv.className= 'input-group w-50';

              var input = document.createElement("input");
              input.placeholder = 'Wprowadź drużynę';
              input.type = 'text';
              input.className='form-control text-center';
              input.autocomplete = 'off';
              input.name = 'teams[]';
              input.required = true;
              input.addEventListener("keypress", validateTeam);
              input.addEventListener("keydown", addDivTeam);

              newDiv.appendChild(input);
              rowDiv.appendChild(newDiv);
              var parentDiv = document.getElementById("parentTeams");
              parentDiv.appendChild(rowDiv);
              input.focus();
          }

  }
