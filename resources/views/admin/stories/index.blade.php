@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Deleted Stories
 
                </div>

                <div class="card-body">
                  <table class="table">
                      <thead>
                            <tr>
                                <td>Title</td>
                                <td>Type</td>
                                <td>Status</td> 
                                
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

                             <td>
                                <form action="{{route('admin.stories.restore', [$story])}}" method="POST">@csrf
                                  @method("PUT")
                                  <button class="btn btn-sm btn-success" type="submit">Restore</button>
                              
                                  </form>
                            </td>
                               <td>
                                  <form action="{{route('admin.stories.delete', [$story])}}" method="POST">@csrf
                                    @method("DELETE")
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                
                                    </form>
                              </td>
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
