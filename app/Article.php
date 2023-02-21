<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['id, featured, title, url, imageUrl, newsSite, summary, publishedAt, launches, events'];

}