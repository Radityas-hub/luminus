<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'forum_id', 'upvotes', 'downvotes','image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'thread_topic');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
{
    return $this->hasMany(ThreadVote::class);
}

}