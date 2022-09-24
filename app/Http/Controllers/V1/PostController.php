<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostTranslationResource;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index($locale)
    {
        $post_by_locale = $this->postRepository->allPosts($locale);

        return PostTranslationResource::collection($post_by_locale);
    }

    //Single Post by Locale
    public function singlePost(Request $request, $locale, Post $post)
    {

        $post_by_locale = $this->postRepository->singlePosts($locale, $post);

        return new PostTranslationResource($post_by_locale);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCalendarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();

        $lang_translate = $this->postRepository->postCreate($data);

        return new PostTranslationResource($lang_translate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $locale = null, Post $post)
    {
        $data = $request->validated();

        $post_by_locale = $this->postRepository->postUpdate($data, $post);

        return new PostTranslationResource($post_by_locale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale = null, Post $post)
    {
        $this->postRepository->postDelete($post);

        return response(null, 204);
    }

}
