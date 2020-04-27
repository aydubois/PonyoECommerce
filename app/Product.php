<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Product extends Model
{
    protected $guarded = [];
    public function schema(Blueprint $table)
    {
        $table->increments('id');
        $table->string('title') ;
        $table->text('description') ;
        $table->unsignedInteger('price_in_cents');
        $table->boolean('valid') ;
        $table->string('image') ;
        $table->integer('stock');
        $table->string('origin_country') ;

        $table->integer('category_id')->unsigned();
        $table->foreign('category_id')->references('id')->on('categories'); 

        $table->timestamps();
    }

}
