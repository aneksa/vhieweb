<?php namespace VhiWeb\Blog\Components;

use Cms\Classes\ComponentBase;
use VhiWeb\Blog\Models\Post;

class PostContent extends ComponentBase
{
    public $post;

    public function componentDetails()
    {
        return [
            'name'        => 'Post Content',
            'description' => 'Content of post'
        ];
    }

    public function defineProperties()
    {
        return [
            'setFindType' => [
                'title' => 'Find Type',
                'description' => 'Open post by.',
                'type' => 'dropdown',
                'default' => 'slug'
            ]
        ];
    }

    public function getSetFindTypeOptions(){
        return [
            'slug' => 'Slug',
            'id' => 'Id'
        ];
    }

    public function onRun(){
        $this->post = $this->loadPost();
    }

    protected function loadPost(){
        $query = [];
        $findType = $this->property('setFindType');
        if($findType == 'slug'){
            $query = Post::where('slug', explode('/', $this->currentPageUrl())[5])->first();
        } else if($findType == 'id'){
            $query = Post::find(explode('/', $this->currentPageUrl())[5]);
        }
        
        return $query;
    }
}
