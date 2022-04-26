@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$story->title}} by {{$story->user->name}}
                
                <a class="btn-sm btn btn-warning" style="float:right;" href="{{route('dashboard.index')}}">Back</a>
                </div>

                <div class="card-body">
                     {{-- {{$story->body}}
                    <br>
                  <p class="btn btn-secondary">{{$story->footnote}}</p> --}}
                  <img class="card-img-top" src="{{$story->thumbnail}}" alt="image">
                  <p class="card-text">{{$story->body}}</p>
                  @foreach($story->tags as $tag)
                    <button type="button" class="btn btn-sm btn-outline-primary">{{$tag->name}}</button>
                    @endforeach
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">{{$story->user->name}}</button>
                     </div>
                    <small class="text-muted">{{$story->footnote}}</small>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
