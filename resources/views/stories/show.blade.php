@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$story->title}}
                
                <a class="btn-sm btn btn-warning" style="float:right;" href="{{route('stories.index')}}">Back</a>
                </div>

                <div class="card-body">
                     {{$story->body}}

                     <p class="">
                        Status: {{$story->status == 1 ? 'Yes' : 'No'}}
                        <br>
                        Type: {{$story->type}}
                     </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
