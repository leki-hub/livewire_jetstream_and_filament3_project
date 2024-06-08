<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Post extends Model
{

    use HasFactory;

    protected $casts = [
      'published_at' => 'datetime',
  ];

     public function author(){
      return $this->belongsTo(User::class,'user_id');
     }

    // add the scope keyword,for laravel to know that its published scope
    
 public  function scopePublished($query){
    
   $query->where('published_at','<=',Carbon::now());
     }
     public  function scopeFeatured($query){
    
        $query->where('featured',true);
     }
     public function getExcerpt(){
      return Str::limit(strip_tags($this['body']),150);
     }

   public function getReadingTime(){
      $words = str_word_count($this->body);
      $readingTime = ceil($words/250);
      return ($readingTime<1?1:$readingTime);
      
   }
}
