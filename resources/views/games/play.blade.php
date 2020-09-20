@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <span>{{ $game->title }}</span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class='row text-center'>
                    @foreach($game->levels->sortByDesc('speed') as $level)
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="speed[]" id="{{$level->speed}}" value="{{$level->speed}}">
                        <label class="form-check-label" for="speed">{{ $level->title}}</label>
                        </div>
                    @endforeach
                    </div>
                    <div class='row text-center mt-3'>
                        <button class='btn btn-md btn-success' disabled style=' margin: 0 auto;' id='start'>Start</button>
                    </div>
                    <div class='row text-center mt-5'>
                        <h1 style=' margin: 0 auto;' id='show_letter'>A</h1>
                    </div>
                    <div class='row text-center mt-5 mb-5'>
                        <input type='text' min='1' max='1' style=' margin: 0 auto;' name='input_letter' id='input_letter'>
                    </div>
                    <div>Test</div>
                    <div>dev branch</div>

                    <div class='row text-center'>
                        @php 
                        $alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
                        @endphp

                        @foreach($alphabet as $key => $letter)
                        
                        <span class="mr-5"><h1>{{strtoupper($letter)}} ({{$key +1 }})</h1></span>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

});
</script>
@endsection
