<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Category;
use App\User;
use App\Events\CreateEvent;
use App\Events\UpdateEvent;
use App\Events\DeleteEvent;

class Post extends Model
{
    protected $fillable=[
      'user_id',
      'category_id',
      'title',
      'content',
      'image_path',
        'status'

    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $dispatchesEvents = [
        'created' => CreateEvent::class,
        'updated' => UpdateEvent::class,
        'deleted' => DeleteEvent::class,
    ];





}
