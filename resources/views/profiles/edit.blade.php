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

                    <form action="{{route('profile.update', [$user])}}" method="POST">@csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name)}}" placeholder="Enter name">
                        
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>    
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{$user->email}}" readonly>
                         
                        </div>

                        <div class="form-group">
                            <label for="name">Address:</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $user->profile->address ?? '')}}" placeholder="Enter address">
                        
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>    
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="biography">Biography:</label>
                            <textarea class="form-control @error('biography') is-invalid @enderror" name="biography" placeholder="Enter biography">{{old('biography', $user->profile->biography ?? '')}}</textarea>
                            @error('biography')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>    
                        @enderror
                        </div>
                        <br />
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
