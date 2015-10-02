<?php

return [

    'allow-non-admin-create-blog' => [
        'type' => 'boolean',
        'title' => 'Allow Members Create Blog',
        'description' => 'Option to enable recent pages on the side bar',
        'value' => '1',
    ],

    'blog-listing-limit' => [
        'type' => 'integer',
        'title' => 'Blogs List Per Page',
        'description' => 'Option to set the number of blogs to list per page',
        'value' => '10'
    ],

    'blog-meta-keywords' => [
        'type' => 'textarea',
        'title' => 'Blog Meta Keywords',
        'description' => 'Option to set your blog meta keywords',
        'value' => 'blog, blogs, journals'
    ],

    'blog-meta-description' => [
    'type' => 'textarea',
    'title' => 'Blog Meta Description',
    'description' => 'Option to set your blog meta description',
    'value' => 'blog, blogs, journals'
]

];