<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // Le pasamos el post a la vista
    public $post;
    public $isLiked; // Para saber si ya le dio like
    public $likes; // Para saber el total de likes

    public function mount($post){
        // Cuando se instacie el componente le pasamos el post y revisamos si ya le dio like
        $this->isLiked = $post->checkLike(auth()->user());
        // Contamos el total de likes
        $this->likes = $post->likes->count();
    }
    // Funcion like
    public function like(){
        // Revisar si ya le dio like
        if($this->post->checkLike(auth()->user())) {
            // Eliminamos el like
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            // Cambiamos el valor de isLiked
            $this->isLiked = false;
            // Le quitamos un like a la cantidad
            $this->likes--;
        }else{
            // Creamos el like
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            // Cambiamos el valor de isLiked
            $this->isLiked = true;
            // Le sumamos uno like a la cantidad
            $this->likes++;
        }
    }
    public function render()
    {
        return view('livewire.like-post');
    }
}
