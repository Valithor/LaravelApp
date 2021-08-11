@extends('layout')
@section('content')
    
<div class="container">
    <div class="col 12 mb-4">
        <div class="card">
            
            <div class="card-header bg-primary text-light text-center">
                <h1>Wylosowana liczba</h1>    
            </div>

            <div class="card-body">                                  
                <div class="row p-1">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-center">
                                <h1>
                                    {{ $rand_value }}
                                </h1>
                            </a>                     
                        </div>  
                    </div>
                </div>
               
                <form method="post" id="form" action="{{route('randomize.store')}}" name="form" class="form-horizontal" data-response-message-animation="slide-in-left" novalidate>
                    @csrf
                    <div class="row pt-4">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-lg bg-primary text-light m-2">
                                <h6>Ponowne Losowanie</h6>
                            </button>
                            <a href="/randomize" type="submit" class="btn btn-lg bg-primary text-light m-2"><h6>Anuluj</h6></a>
                        </div> 
                    </div>  
                </form> 

            </div>
        </div>
    </div>

@endsection

        
        


