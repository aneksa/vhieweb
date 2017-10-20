<?php namespace VhiWeb\Blog\Components;

use Cms\Classes\ComponentBase;
use VhiWeb\Blog\Models\Post;

class Posts extends ComponentBase
{
    public $posts;

    public function componentDetails()
    {
        return [
            'name'        => 'Post Lists',
            'description' => 'List of the posts'
        ];
    }

    public function defineProperties()
    {
        return [
            'results' => [
                'title' => 'Number of Posts',
                'description' => 'How many do you want to display?',
                'default' => 0,
                'validationPatern' => '^[0-9]+$',
                'validationMessage' => 'Only number allowed'
            ],

            'sortOrder' => [
                'title' => 'Sort Posts',
                'description' => 'Sort those posts',
                'type' => 'dropdown',
                'default' => 'asc'
            ]
        ];
    }

    public function getSortOrderOptions(){
        return [
            'asc' => 'Ascending',
            'desc' => 'Descending'
        ];
    }

    public function onRun(){
        $this->posts = $this->loadPosts();
    }

    protected function loadPosts(){
        $query = Post::all();
        
        if($this->property('sortOrder') == 'asc'){
            $query = $query->sortBy('created_at');
        }

        if($this->property('sortOrder') == 'desc'){
            $query = $query->sortByDesc('created_at');
        }

        if($this->property('results') > 0){
            $query = $query->take($this->property('results'));
        }
        
        return $query;
    }
}
