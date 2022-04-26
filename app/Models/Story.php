<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\StoryCreated;
use App\Events\StoryEdited;
 
class Story extends Model
{
    use HasFactory;
    use SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
        'type',
        'status'
    ];    

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function getTitleAttribute($value){
        return ucfirst($value);
    }

    public function getFootnoteAttribute(){
        return $this->type .' type, created at '.date('Y-m-d', strtotime($this->created_at));
    }

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);

    }

    public function getThumbnailAttribute(){

        if($this->image){
            return asset('storage/'.$this->image);
        }

        return asset('storage/thumbnail.png');


    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function scopeActive($query){
        $query->where('status', 1);
    } 

    public function scopeWhereCreatedThisMonth($query){
        $startdate = Carbon::now()->startOfMonth();
        $enddate = Carbon::now()->endOfMonth();

        return $query->whereBetween('created_at', [$startdate, $enddate]);

    }

    protected static function booted(){

        static::created( function($story){
            //event(new StoryCreated($story->title));
        });

        static::updated( function($story){
           // event(new StoryEdited($story->title)); 
        });
    }

   
}
