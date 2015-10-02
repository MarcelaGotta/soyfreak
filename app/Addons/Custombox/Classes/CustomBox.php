<?php
namespace App\Addons\Custombox\Classes;
use Illuminate\Database\Eloquent\Model;

/**
*
*@author: Christian Koenig
*@website : http://www.facebook.com/pages/MarvinToys/120541371391828
*/

class CustomBox extends Model
{
    protected $table = "custom_boxes";

    public function deleteIt()
    {
        $this->delete();
    }

    public function url($slug = null)
    {
        return \URL::route('custom-box', ['slug' => $this->slug]).'/'.$slug;
    }

    public function canView()
    {
        if ($this->privacy == 0) return true;
        if ($this->privacy == 1 and \Auth::check()) return true;
        if ($this->privacy == 2 and (\Auth::check() and \Auth::user()->isAdmin())) return true;
        return false;
    }


    public function likes()
    {
        return $this->hasMany('App\\Models\\Like', 'type_id')->where('type', '=', 'custombox');
    }

    public function countLikes()
    {
        return count($this->likes);
        //return app('App\\Repositories\\LikeRepository')->count('post', $this->id);
    }

    public function hasLiked()
    {
        if (!\Auth::check()) return false;

        return app('App\\Repositories\\LikeRepository')->hasLiked('custombox', $this->id, \Auth::user()->id);
    }

}