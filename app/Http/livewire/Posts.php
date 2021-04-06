<?php

namespace App\Http\Livewire;

use http\Env\Request;
use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class Posts extends Component
{
    public $posts, $title, $body, $published, $post_id;
    public $viewAll = 0;
    public $title_filter;
    public $isOpen = 0;

    public function render()
    {
        if($this->viewAll == 0){
            $this->posts = Post::where('user_id', Auth::user()->id)
                ->where('title', 'like', '%' . $this->title_filter. '%')
                ->get();
        } else {
            $this->posts = Post::where('user_id', Auth::user()->id)
                ->orWhere('published', '1')
                ->where('title', 'like', '%' . $this->title_filter. '%')
                ->get();
        }

        return view('livewire.posts');

    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->title = '';
        $this->body = '';
        $this->post_id = '';
    }
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
            'published' => 'required'
        ]);

        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'body' => $this->body,
            'published' => $this->published,
            'user_id' => Auth::user()->id
        ]);

        session()->flash('message',
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->published = $post->published;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }

    public function search(){


        session()->flash('message', 'Searched Post');
    }
}
