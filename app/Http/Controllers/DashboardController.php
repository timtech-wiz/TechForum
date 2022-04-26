<?php

namespace App\Http\Controllers;


use App\Mail\NotifyAdmin;
use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\User;
use Illuminate\Support\Facades\DB;
 

class DashboardController extends Controller
{
    public function index(){
        
        $query = Story::active();

        $type = request()->input('type');
        if(in_array($type, ['short', 'long'])){
            $query->where('type', $type);
        }
        $stories = $query->with(['user', 'tags'])
        ->orderBy('id', 'DESC')->paginate(9);
        return view("dashboard.index", [
            'stories' => $stories
        ]);
    }


    public function show(Story $activeStory)
    {
        return view('dashboard.show',[
            'story' => $activeStory
        ]);
    }

    public function email(){
        // Mail::raw("This is an email", function($message){
        //     $message->to("admin@localhost.com")->subject("A New Story was added by ".auth()->user()->name);
        // });

       
         
    }
}
