<?php

namespace App\Http\Controllers;

use App\Events\StoryCreated;
use App\Events\StoryEdited;
use App\Mail\newStoryNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoryRequest;
use App\Models\Story;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class StoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

            public function __construct()
            {
                return $this->authorizeResource(Story::class, 'story');
            }




    public function index()
    {

        $stories = Story::where('user_id', auth()->user()->id)
        ->with('tags')->orderBy('id', 'DESC')->paginate(3);
        return view("stories.index", [
            'stories' => $stories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $story = new Story();
        $tag = Tag::get();
         
        return view("stories.create", [
            'story' => $story,
            'tags' => $tag
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        $story = auth()->user()->stories()->create($request->all());
        if($request->hasFile('image')){
            $this->_uploadImage($request, $story);
        }
        $story->tags()->sync($request->tags);
        // Mail::send(new newStoryNotification($story->title));
        // Log::info("A new story was added with title ".$story->title);
        // event(new StoryCreated($story->title));


       return redirect()->route("stories.index")->with("status", "Story Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
    
         
        return view('stories.show',[
            'story' => $story
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        $tag = Tag::get();
       return view("stories.edit",[
          'story' => $story,
          'tags' => $tag
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoryRequest $request, Story $story)
    { 
       $story->update($request->all());
       if($request->hasFile('image')){
            $this->_uploadImage($request, $story);
       }
       $story->tags()->sync($request->tags);
    //    event(new StoryEdited($story->title)); 

       return redirect()->route("stories.index")->with("status", "Story Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        $story->delete();
        return redirect()->route("stories.index")->with("status", "Story Deleted Successfully");

    }

    private function _uploadImage($request, $story){
        
            $image = $request->file('image');
            $filename = time() .'.'.$image->getClientOriginalExtension();
    
            Image::make($image)->resize(255, 100)->save(public_path('storage/'.$filename));
            $story->image = $filename;
            $story->save();
    
        
    }
}
