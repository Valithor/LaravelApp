@extends('layout') 
@section('content')

@if(!empty($msg))
  <div class="alert alert-danger"> {{ $msg }}</div>
@endif

    <div class="container">
        <div class="col 12 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-light text-center">
                    <h1>Losowanie komentarzy</h1>    
                </div>
                <div class="card-body">                    
                        <form method="post" id="form" action="{{route('youtube.store')}}" name="form" class="form-horizontal" data-response-message-animation="slide-in-left" novalidate>
                           @csrf
                           <div class="row">
                                <div class="col-sm-4 text-right">    
                                    <div class="controls">
                                        <label class="checkbox pt-2">Adres url filmu</label>                                  
                                    </div>
                                </div>                    
                            
                            <div class="col-sm-8">
                                <div class="form-group  w-75">
                                    @if(!empty($url))
                                        <input name="url" class="form-control" type="text" autocomplete="off" placeholder="Adres URL filmu" required value="{{ $url }}">
                                    @else
                                        <input name="url" class="form-control" type="text" autocomplete="off" placeholder="Adres URL filmu" required>
                                    @endif
                                </div>
                                
                                <div class="controls">
                                    <label class="checkbox">
                                        <input class="m-2" type="checkbox" checked="checked" name="uniqueUser">Bez duplikatów
                                    </label>                                  
                                </div>
                                
                                <div class="controls">
                                    <label class="text-dark">
                                        <input class="m-2" type="checkbox" name="hasText" id="showDiv" class="form-check-input" onclick="showInput()">Komentarz zawiera określony tekst
                                    </label>                            
                                </div>

                                <div class="form-group" id="show" style="display:none;"> 
                                    <input type="text" name="text" class="form-input" autocomplete="off" placeholder="#GIVEAVAY">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-lg bg-primary text-light ">
                                    <h6>Losuj komentarz</h6>
                                </button>
                            </div> 
                        </div>   
                    </form>  
            </div>
        </div>
      
<script>
function showInput(){
    var checkbox= document.getElementById("showDiv");
    var elem= document.getElementById("show");
      
    if(checkbox.checked){
       elem.style.display= 'block';
    }
    else{
        elem.style.display= 'none';
    }
}
</script>
@endsection