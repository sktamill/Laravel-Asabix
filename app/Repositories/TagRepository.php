<?php

namespace App\Repositories;

use App\Models\PostTag;
use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{

    public function allTags()
    {
        return Tag::all();
    }

    public function tagsCreate($data)
    {
        return Tag::firstOrCreate($data);
    }

    public function tagsUpdate($data, $tag)
    {
        return $tag->update($data);
    }

    public function tagsDelete($tag)
    {
        PostTag::where('tag_id', $tag->id)->delete();
        $tag->delete();
        return true;
    }
}
