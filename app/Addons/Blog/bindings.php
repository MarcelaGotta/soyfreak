<?php

\Menu::add('admincp-menu', 'blog', [
    'link' => '',
    'name' => 'Manage Blogs'.'<span style="background:green;padding:5px;border-radius:5px">'.app('App\\Addons\\Blog\\Classes\\BlogRepository')->countAll().'</span>',
]);

\Menu::add('sub-menu-blog', 'blogs', [
    'link' => \URL::to('admincp/blog/posts'),
    'name' => 'Posts',
]);

\Menu::add('sub-menu-blog', 'add', [
    'link' => \URL::to('admincp/blog/add'),
    'name' => 'Add New Blog',
]);


\Menu::add('sub-menu-blog', 'categories', [
    'link' => \URL::to('admincp/blog/categories'),
    'name' => 'Categories',
]);

\Menu::add('sub-menu-blog', 'categories-add', [
    'link' => \URL::to('admincp/blog/categories/add'),
    'name' => 'Add New Category',
]);

app('menu')->add('site-menu', 'blogs', [
    'name' => 'Noticias',
    'link' => \URL::to('blogs'),
    'ajaxify' => true,
    'icon' => '<i class="icon ion-clipboard"></i>'
]);

Event::listen('user-profile-menu', function() {
    if (Config::get('allow-non-admin-create-blog', true)) echo Theme::section('blog::extend-profile');
});

Event::listen('blog.add', function($blog) {
    $postRepository = $this->app->make('App\\Repositories\\PostRepository');
    $post = $postRepository->model->newInstance();
    $post->text = '';
    $post->user_id = \Auth::user()->id;
    $post->to_user_id = 0;
    $post->content_type = 'add-blog';
    $post->type_content = perfectSerialize([
        'blog_id' => $blog->id
    ]);
    $post->type = 'user-timeline';
    $post->type_id = '';
    $post->community_id = '';
    $post->page_id = '';
    $post->tags = '';
    $post->privacy = 1;
    $post->video_path = '';
    $post->auto_like_id = '';
    $post->file_path = '';
    $post->file_path_name = '';

    $post->save();

    if (app('App\Repositories\AddonRepository')->isActive('activity')) {
        app('App\\Addons\\Activity\\Classes\\ActivityRepository')->add('blog', $blog->id, 'blog::activity.create', ['blog' => $blog]);
    }


});

Event::listen('post-body', function($post) {
   echo Theme::section('blog::inline-post', ['post' => $post]);
});

Event::listen('comment.add', function($text, $userid, $type, $typeId, $comment, $image) {
   if ($type == 'blog') {
       $blog = app('App\\Addons\\Blog\\Classes\\BlogRepository')->findById($typeId);
       $notification = app('App\\Repositories\\NotificationRepository');
       if ($blog->user_id != \Auth::user()->id) {
           $notification->send($blog->user_id, [
               'path' => 'blog::notification.comment',
               'blog' => $blog
           ]);
       }
   }
});

Event::listen('like.add', function($userid, $type, $typeId) {
    if ($type == 'blog') {
        $blog = app('App\\Addons\\Blog\\Classes\\BlogRepository')->findById($typeId);
        $notification = app('App\\Repositories\\NotificationRepository');
        if ($blog->user_id != \Auth::user()->id) {
            $notification->send($blog->user_id, [
                'path' => 'blog::notification.like',
                'blog' => $blog
            ]);
        }
    }
});

Event::listen('user-side-preview-card', function() {
   echo Theme::section('blog::create-button');
});



function blogLawedContent($t, $C=1, $S=array()) {
    if(!function_exists('htmLawed')) {
        require_once "library/htmLawed.php";
    }
       return htmLawed($t, $C, $S);
}