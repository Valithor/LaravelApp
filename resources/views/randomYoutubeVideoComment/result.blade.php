@extends('layout')
@section('content')
<div class="container">
    <div class="col 12 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-light text-center">
                <h1>Wylosowany komentarz</h1>    
            </div>
            <div class="card-body">   
                               
                <div class="row p-1">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-center">
                            <a href="{{ $randComment['authorLink'] }}" target="_blank">
                                <h4>
                                    <img src="{{ $randComment['img'] }}" alt="Img">
                                    {{ $randComment['author'] }}
                                </h4>
                            </a>                     
                        </div>  
                    </div>
                </div>

                <div class="row pt-3" >
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-center">
                            <h6>{{ strip_tags($randComment['comment']) }}</h6>           
                        </div>  
                    </div>
                </div>
                
                <form method="post" id="form" action="{{route('youtube.store')}}" name="form" class="form-horizontal" data-response-message-animation="slide-in-left" novalidate>
                    @csrf
                    <div class="row pt-4">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-lg bg-primary text-light m-2">
                                <h6>Ponowne Losowanie</h6>
                            </button>
                            <a href="/youtube" type="submit" class="btn btn-lg bg-primary text-light m-2"><h6>Anuluj</h6></a>
                        </div> 
                    </div>  
                </form>  

            </div>
        </div>
    </div>
    
@endsection