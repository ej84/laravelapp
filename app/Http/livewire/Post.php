<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Post extends Component
{
    public $posts, $title, $body, $published, $post_id, $current_post;
    public $isOpen = 0;

    public function mount($id=false)
    {
        $this->current_post = $id;

    }
    public function render()
    {

        $this->posts = \App\Models\Post::where('id', '=', $this->current_post)
            ->get();
        return view('livewire.post');

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
        $this->published = '1';
        $this->post_id = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
            'published' => 'required'
        ]);

        \App\Models\Post::updateOrCreate(['id' => $this->post_id], [
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
        $post = \App\Models\Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->body = $post->body;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        \App\Models\Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
        redirect('/posts');
    }

}
