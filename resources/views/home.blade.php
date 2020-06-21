@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <span>Games</span>
                </div>

                <div class="card-body">
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
                                <a class="btn btn-outline-info btn-sm" href="{{ route('play',['game' => $game->id]) }}">Play</a>
                                <a class="btn btn-outline-dark btn-sm" href="{{ route('stats',['game' => $game->id]) }}">Stats</a>
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
