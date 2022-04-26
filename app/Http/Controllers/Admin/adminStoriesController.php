<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class adminStoriesController extends Controller
{
    public function index(){
        $stories = Story::onlyTrashed()
        ->with('user')->orderBy('id', 'DESC')->paginate(3);
        return view("admin.stories.index", [
            'stories' => $stories
        ]);
        
    }

    public function restore($id){
        $story = Story::withTrashed()->findOrFail($id);
            $story->restore();
            return redirect()->route("admin.stories.index")->with("status", "Story Restored Successfully");

    }

    public function delete($id){
        $story = Story::withTrashed()->findOrFail($id);
        $story->forceDelete();
        return redirect()->route("admin.stories.index")->with("status", "Story Deleted Successfully");

}

    public function stats(){
        $stories = Story::active()->whereCreatedThisMonth()
        ->with('user')->orderBy('id', 'DESC')->paginate(10);
         
        return view("admin.stories.stats", [
            'stories' => $stories
        ]);

       

    }


}
