<?php

namespace App\Repositories\Interfaces;

interface TagRepositoryInterface
{
    public function allTags();

    public function tagsCreate($data);

    public function tagsUpdate($data, $tag);

    public function tagsDelete($tag);
}
