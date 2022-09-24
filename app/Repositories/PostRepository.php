<?php

namespace App\Repositories;

use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function allPosts($locale)
    {
        $locale_id = Language::where('locale', $locale)->firstOrFail()->id;

        return PostTranslation::where('language_id', $locale_id)->paginate(3);
    }

    public function singlePosts($locale, $post)
    {
        $locale_id = Language::where('locale', $locale)->firstOrFail()->id;

        return PostTranslation::where('language_id','=',$locale_id)->where('post_id','=',$post->id)->first();

    }

    public function postCreate($data)
    {
        $post = Post::create();

        $lang_id = Language::where('prefix','=',$data['language'])->firstOrFail()->id;


        if(!empty($data['tags'])) {
            $tags = explode(',', $data['tags']);

            foreach ($tags as $tagitem) {
                $tagIds[] = Tag::firstOrCreate(['name' => $tagitem])->id;
            }

            $post->tags()->attach($tagIds);
        }

        $lang_translate = PostTranslation::create([
            'post_id' => $post->id,
            'language_id' => $lang_id,
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
        ]);

        return $lang_translate;
    }

    public function postUpdate($data, $post)
    {
        $lang_id = Language::where('prefix','=',$data['language'])->firstOrFail()->id;

        PostTranslation::where('post_id','=',$post->id)->update([
            'language_id' => $lang_id,
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
        ]);

        if(!empty($data['tags'])) {
            $tags = explode(',', $data['tags']);

            foreach ($tags as $tagitem) {
                $tagIds[] = Tag::firstOrCreate(['name' => $tagitem])->id;
            }

            $post->tags()->sync($tagIds);
        }

        return PostTranslation::where('post_id','=',$post->id)->first();
    }

    public function postDelete($post)
    {
        PostTranslation::where('post_id','=',$post->id)->delete();
        $post->tags()->detach();
        $post->delete();

        return true;
    }

}
