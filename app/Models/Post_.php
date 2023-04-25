<?php

namespace App\Models;


class Post 
{
    static $blog_posts = [
        [
            "title"=>"Judul Tulisan Pertama",
            "slug" => "judul-tulisan-pertama",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro officiis assumenda temporibus qui reiciendis iure, ducimus error! Temporibus laudantium saepe harum voluptatem perspiciatis, beatae error voluptate, ullam nostrum officia ea recusandae? Quae hic vel optio quas corporis. Iste commodi id nisi. Ipsam ex laudantium, temporibus debitis placeat inventore corrupti unde nemo optio rem dolorum eveniet fugit explicabo eos assumenda delectus officia voluptate in reprehenderit, maxime doloremque ullam expedita? Quam et eos ut ab sit dicta dolore molestias. Est dolores ea fuga veritatis dolorum nostrum eos distinctio. Maxime debitis voluptatem, odit similique magnam ratione iusto officia! Aperiam repellendus iste minima suscipit."
        ],
        [
            
            "title"=>"Judul Tulisan Ke Dua",
            "slug" => "judul-tulisan-ke-dua",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro officiis assumenda temporibus qui reiciendis iure, ducimus error! Temporibus laudantium saepe harum voluptatem perspiciatis, beatae error voluptate, ullam nostrum officia ea recusandae? Quae hic vel optio quas corporis. Iste commodi id nisi. Ipsam ex laudantium, temporibus debitis placeat inventore corrupti unde nemo optio rem dolorum eveniet fugit explicabo eos assumenda delectus officia voluptate in reprehenderit, maxime doloremque ullam expedita? Quam et eos ut ab sit dicta dolore molestias. Est dolores ea fuga veritatis dolorum nostrum eos distinctio. Maxime debitis voluptatem, odit similique magnam ratione iusto officia! Aperiam repellendus iste minima suscipit."
        ]
    ];
    public static function all (){
        return collect(self::$blog_posts);
    }
    public static function find($slug){
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
