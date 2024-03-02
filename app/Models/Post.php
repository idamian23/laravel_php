<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $excerpt;

    public $data;

    public $body;

    public $slug;


    /**
     * @param $title
     * @param $excerpt
     * @param $data
     * @param $body
     */
    public function __construct($title, $excerpt, $data, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->data = $data;
        $this->body = $body;
        $this->slug = $slug;
    }


    public static function all()
    {
        return collect(File::files(resource_path("posts/")))
            ->map(function ($file) {
                return YamlFrontMatter::parseFile($file);
            })->map(function ($document) {
                return new Post(
                    $document->title,
                    $document->excerpt,
                    $document->data,
                    $document->body(),
                    $document->slug
                );
            });
    }

    public static function find($slug)
    {
        return static::all()->firstWhere('slug', $slug);
    }


}
