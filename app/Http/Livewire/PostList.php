<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Computed;



class PostList extends Component
{
   
    public $direction= 'desc';
    // use WithPagination
    // you can also create a computed property insted, accessible in our blade , though computed properties doesnt support pagination.
    #[Computed()]
     public function getPostsProperty() {
       return  Post::orderBy('published_at',$this->direction)->take(5)->paginate(3);
     }
    public function render()
    
    {
      
        $someposts= Post::orderBy('published_at',$this->direction)->take(5)->paginate(3);
        return view('livewire.post-list',['posts' =>$someposts]);
    }
}
