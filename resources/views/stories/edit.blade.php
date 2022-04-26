@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Story

                    <a class="btn-sm btn btn-warning" style="float:right;" href="{{route('stories.index')}}">Back</a>

                </div>

                <div class="card-body">

                    <form action="{{route('stories.update', [$story])}}" method="POST" enctype="multipart/form-data">@csrf
                        @method('PUT')

                        @include('stories.form')

                         <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update" placeholder="Enter Title">
                         </div>
                         

                    </form>
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
