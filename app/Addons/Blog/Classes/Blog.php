<?php
namespace App\Addons\Blog\Classes;
use Illuminate\Database\Eloquent\Model;

/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class Blog extends Model
{
    protected $table = "blogs";

    public function user()
    {
        return $this->belongsTo('App\\Models\\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\\Addons\\Blog\\Classes\\BlogCategory', 'category_id');
    }

    public function stripped()
    {
        return strip_tags(\Str::limit($this->content, 200));
    }

    public function url($slug = null)
    {
        return \URL::route('blog-page', ['slug' => $this->slug]).'/'.$slug;
    }

    public function time()
    {
        return str_replace(' ', 'T', $this->created_at).'Z';
    }

    public function canEdit()
    {
        if (!\Auth::check()) return false;

        if (\Auth::user()->isAdmin()) return true;
        return $this->isOwner();
    }

    public function isGood()
    {
        return $this->user;
    }

    public function canView()
    {
        return true;
        if ($this->privacy == 0 or $this->privacy == 1 or $this->isOwner() or (\Auth::check() and \Auth::user()->isAdmin())) return true;

        if ($this->privacy == 2) {
            //we need to know that only friends can see this
            if (!\Auth::check()) return false;
            $connectionRepository = app('App\\Repositories\\ConnectionRepository');
            if ($connectionRepository->areFriends($this->user_id, \Auth::user()->id)) return true;
        }
        return false;
    }

    public function isOwner()
    {
        if (!\Auth::check()) return false;
        return (\Auth::user()->id == $this->user_id);
    }

    public function deleteIt()
    {

        app('App\\Repositories\\CommentRepository')->deleteByType('blog', $this->id);
        app('App\\Repositories\\LikeRepository')->deleteByType('blog', $this->id);

        $this->delete();
    }

    public function likes()
    {
        return $this->hasMany('App\\Models\\Like', 'type_id')->where('type', '=', 'blog');
    }

    public function countLikes()
    {
        return count($this->likes);
        //return app('App\\Repositories\\LikeRepository')->count('page', $this->id);
    }

    public function friendsLiked()
    {
        return app('App\\Repositories\\LikeRepository')->friendsLike('blog', $this->id, 12);
    }

    public function hasLiked()
    {
        if (!\Auth::check()) return false;

        return app('App\\Repositories\\LikeRepository')->hasLiked('blog', $this->id, \Auth::user()->id);
    }

    public function comments()
    {
        return $this->hasMany('App\\Models\\Comment', 'type_id')->where('type', '=', 'blog')->orderBy('id', 'desc');
    }


    public function countComments()
    {
        return count($this->comments)   ;
    }
}
 