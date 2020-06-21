@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Game</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="#" >
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="game_title">Game Title</label>
                            <input disabled type="text" class="form-control" id="game_title" name="game_title" value="{{ $game->title }}" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                            <input disabled class="form-check-input" type="checkbox" value="{{$game->status}}" name="status" id="status" {{ ($game->status)  ? "checked":"" }}>
                            <label class="form-check-label" for="status" >
                                Published
                            </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <strong class="float-right" id='add_level' style="color:red;">+ Add Level</strong> -->
                        </div>
                        <div class="levels form-row">
                        @if($game->levels)
                            @foreach($game->levels->sortByDesc('speed') as $level)
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="level_title">Level Title</label>
                                    <input disabled type="text" class="form-control" id="level_title" name="titles[]" value="{{ $level->title }}" required>
                                </div>
                                <div class="col-md-6 mb-6">
                                    <label for="level_speed">Level Speed</label>
                                    <input disabled type="number" min="0" class="form-control" id="level_speed" name="speeds[]" value="{{ $level->speed }}" required>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        </div>
                        <a class='btn btn-md btn-success mt-3' href="{{ route('play',['game'=>$game->id])" class="btn btn-primary mt-3">Play</a>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

    $('#add_level').click(function(){
        console.log('new');
        $('.levels').append('<div class="form-row">'
        + '<div class="col-md-6 mb-6">'
        + '<label for="level_title">Level Title</label>'
        + '<input type="text" class="form-control" id="level_title" name="titles[]" required>'
        + '</div>'
        + '<div class="col-md-6 mb-6">'
        + '<label for="level_speed">Level Speed</label>'
        + '<input type="number" min="0" class="form-control" id="level_speed" name="speeds[]" required>'
        + '</div>'
        + '</div>'
        );

    });
    
});
</script>
@endsection
