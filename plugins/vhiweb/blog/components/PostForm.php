<?php namespace VhiWeb\Blog\Components;

use Cms\Classes\ComponentBase;
use Flash;
use Input;
use Redirect;
use Validator;
use Carbon\Carbon;
use VhiWeb\Blog\Models\Post;

class PostForm extends ComponentBase
{
    public $postForm;

    public function componentDetails()
    {
        return [
            'name'        => 'Form Post',
            'description' => 'Form upload post'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onSave(){
        $post = new Post();
        $now = new Carbon();

        $post->title = Input::get('title');
        $post->slug = str_slug($now, '-').'-'.str_slug($post->title, '-');
        $post->content = Input::get('content');
        $post->photo = Input::file('photo');
        $post->save();

        if($post){
            Flash::success('Post added..');
        }

        return Redirect::back();
    }

}
