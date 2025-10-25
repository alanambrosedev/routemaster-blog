<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //By default laravel uses primary key ID. You can override using getRouteName
    public function getRouteKeyName()
    {
        return 'title';  //Now /posts/lorem automatically fetches post with slug = 'lorem'
    }
}
