@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Stories

                    @can('create', App\Models\Story::class)
                    <a href="{{route('stories.create')}}" style="float: right" class="btn-sm btn btn-success">Create</a>
                    @endcan
                </div>

                <div class="card-body">
                  <table class="table">
                      <thead>
                            <tr>
                                <td>Image</td>
                                <td>Title</td>
                                <td>Type</td>
                                <td>Tags</td>
                                <td>Status</td> 
                                <td>Actions</td> 
                            </tr>  
                      </thead>
                      <tbody>
                          @foreach($stories as $story)
                          <tr>
                              <td><img src="{{$story->thumbnail}}"  alt="image" /></td>
                              <td>{{$story->title}}</td>
                              <td>{{$story->type}}</td>
                              <td>
                              @foreach($story->tags as $tag)
                                {{$tag->name}}
                              @endforeach
                            </td>
                              <td>
                                  {{$story->status == 1 ? 'Yes' : 'No'}}
                             </td>
                             <td><a class="btn btn-sm btn-primary" href="{{route('stories.show', $story)}}">View</a></td>
                             <td><a class="btn btn-sm btn-secondary" href="{{route('stories.edit', $story)}}">Edit</a></td>
                              <td>
                                  <form action="{{route('stories.destroy', [$story])}}" method="POST">@csrf
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
