@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Story

                    <a class="btn-sm btn btn-warning" style="float:right;" href="{{route('stories.index')}}">Back</a>

                </div>

                <div class="card-body">

                    <form action="{{route('stories.store')}}" method="POST" enctype="multipart/form-data">@csrf
                            @include('stories.form')
                         <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Save" placeholder="Enter Title">
                         </div>
                         

                    </form>
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
