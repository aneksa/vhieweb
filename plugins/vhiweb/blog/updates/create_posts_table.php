<?php namespace VhiWeb\Blog\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('vhiweb_blog_posts', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vhiweb_blog_posts');
    }
}
