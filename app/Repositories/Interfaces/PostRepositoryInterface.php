<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function allPosts($locale);

    public function singlePosts($locale, $post);

    public function postCreate($data);

    public function postUpdate($data, $post);

    public function postDelete($post);
}
