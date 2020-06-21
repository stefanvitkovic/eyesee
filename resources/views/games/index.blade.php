@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <span>My Games</span>
                </div>

                <div class="card-body">
                <a class="btn btn-outline-success btn-sm float-right mb-3" href="{{ route('games.create') }}">Create</a> 
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Levels</th>
                        <th scope="col">Status</th>
                        <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($games as $game)
                        <tr>
                            <th scope="row">{{ $game->id }}</th>
                            <td>{{ $game->title }}</td>
                            <td>{{ $game->user->name }}</td>
                            <td>{{ $game->levels->count() }}</td>
                            <td>{{ ($game->status) ? 'published' : 'unpublished' }}</td>
                            <td class='text-center'>
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('games.show',['game' => $game->id]) }}">View</a>
                                <a class="btn btn-outline-warning btn-sm" href="{{ route('games.edit',['game' => $game->id]) }}">Edit</a>
                                <a class="btn btn-outline-dark btn-sm" href="{{ route('stats',['game' => $game->id]) }}">Stats</a>
                                <form style="display: inline-block;" action="{{ route('games.destroy',['game' => $game->id]) }}" method="post">
                                    <input class="btn btn-outline-danger btn-sm" type="submit" value="Delete" />
                                    <input type="hidden" name="_method" value="delete" />
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
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
