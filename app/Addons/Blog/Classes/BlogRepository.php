<?php
namespace App\Addons\Blog\Classes;
/**
*
*@author: Tiamiyu waliu kola
*@website : www.crea8social.com
*/
class BlogRepository
{
    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    public function countMine($userid)
    {
        return count($this->model->where('user_id', $userid)->get());
    }

    public function getMyList($userid)
    {
        return $this->model->where('user_id', $userid)->paginate(\Config::get('blog-listing-limit', 10));
    }
    /**
     * Method to add blog
     *
     * @param array $val
     * @param object $blog
     * @return object|boolean
     */
    public function add($val, $blog = null)
    {
        $expected = [
            'title' => '',
            'post' => '',
            'category' => '',
            'tags' => '',
            'privacy' => '',
            'comment' => '',
            'like' => '',
            'status' => ''
        ];

        /**
         * @var $title
         * @var $post
         * @var $category
         * @var $tags
         * @var $privacy
         * @var $comment
         * @var $like
         * @var $status
         */
        extract(array_merge($expected, $val));

        $userid = \Auth::user()->id;

        if (!$this->exists($title, $userid, $blog)) {
            $slug = hash('crc32', $title.time());
            $slug = $slug.'-'.\Str::slug($title);
            $edit = false;
            if ($blog) {
                $userid = $blog->user_id;
                $edit = true;
            }

            $blog = (!$blog) ? $this->model->newInstance() : $blog;
             $blog->title = sanitizeText($title);
            $blog->user_id = $userid;
            $blog->content = blogLawedContent($post);
            $blog->category_id = sanitizeText($category);
            $blog->privacy = sanitizeText($privacy);
            $blog->show_comments = sanitizeText($comment);
            $blog->show_likes = sanitizeText($like);
            if (!$edit) $blog->slug = $slug;
            $blog->status = sanitizeText($status);
            $blog->tags = sanitizeText($tags);
            $blog->save();

            if (!$edit) \Event::fire('blog.add', [$blog]);
            return $blog;
        }

        return false;

    }



    public function exists($title, $userid, $blog = null)
    {
        $check =  $this->model->where('title', $title)->where('user_id', $userid);

        if ($blog) $check = $check->where('id', '!=', $blog->id);

        return $check = $check->first();
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getLists($category = null, $term = null)
    {
        $blogs = $this->model->where('privacy', 0)->where('status', 1);

        if ($category)  $blogs = $blogs->where('category_id', $category);

        if ($term) $blogs = $blogs->where(function($blogs) use($term) {
            $blogs->where('title', 'LIKE', '%'.$term.'%')
                ->orWhere('content', 'LIKE', '%'.$term.'%')
                ->orWhere('tags', 'LIKE', '%'.$term.'%');
        });

        return $blogs = $blogs->orderBy('id', 'desc')->paginate(\Config::get('blog-listing-limit', 10));
    }

    public function adminLists($term = null)
    {
        $blogs = $this->model;


        if ($term) $blogs = $blogs->where(function($blogs) use($term) {
            $blogs->where('title', 'LIKE', '%'.$term.'%')
                ->orWhere('content', 'LIKE', '%'.$term.'%')
                ->orWhere('tags', 'LIKE', '%'.$term.'%');
        });

        return $blogs = $blogs->orderBy('id', 'desc')->paginate(\Config::get('blog-listing-limit', 10));
    }

    public function countAll()
    {
        return count($this->model->get());
    }
}