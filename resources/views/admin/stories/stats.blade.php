@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Stories Stats
 
                </div>

                <div class="card-body">
                  <table class="table">
                      <thead>
                            <tr>
                                <td>Title</td>
                                <td>Type</td>
                                <td>Author</td> 
                                <td>Date Created</td> 
                            </tr>  
                      </thead>
                      <tbody>
                       
                          @foreach($stories as $story)
                          <tr>
                              <td>{{$story->title}}</td>
                              <td>{{$story->type}}</td>
                              <td>
                                  {{$story->user->name}}
                             </td>
                             <td>{{$story->created_at}}</td>

                             
                          </tr>
                            @endforeach
                      </tbody>
                  </table>
                  {{$stories->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
