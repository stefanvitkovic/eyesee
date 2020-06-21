@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <span>{{ $game->title }}</span>
                </div>
                @if($game->levels != '[]')

                    @foreach($game->levels->sortByDesc('speed') as $level)

                        
                        <div class="card-body"> 
                        <h4>{{$level->title}}</h4>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Hits</th>
                                <th scope="col">Misses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($level->stats != '[]')
                                
                                    @foreach($level->stats()->orderBy('hit','desc')->get()->unique('user_id') as $key => $stat)

                                    <tr>
                                        <th scope="row">{{$key + 1}}</th>
                                        <td>{{$stat->users->first()->name}}</td>
                                        <td>{{$stat->hit}}</td>
                                        <td>{{$stat->miss}}</td>
                                    </tr>
                                        
                                    @endforeach
                                @else
                                <tr>
                                    <th scope="row">/</th>
                                    <td>/</td>
                                    <td>/</td>
                                    <td>/</td>
                                </tr>
                                @endif
                            </tbody>
                            </table>
                        </div>
                    @endforeach
                @else
                <div class="card-body"> 
                    <h>no data</h4>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

});
</script>
@endsection
