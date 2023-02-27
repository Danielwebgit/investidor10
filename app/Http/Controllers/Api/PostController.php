<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostRepository $postRepository)
    {
        return PostResource::collection($postRepository->getAllPosts());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request, PostRepository $postRepository)
    {
        return new PostResource($postRepository->createPost($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($postId, PostRepository $postRepository)
    {
        return new PostResource($postRepository->getPostById($postId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($postId, PostFormRequest $request, PostRepository $postRepository)
    {
        $updatePost = $postRepository->updatePost($postId, $request->all());
        if($updatePost){

            return Response()->json(['response' => 'Poste atualizado com sucesso!']);
        } 
        return Response()->json(['response' => 'Problema ao atualizar'], 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId, PostRepository $postRepository)
    {
        $postDelete = $postRepository->deletePost($postId);
        if($postDelete){

            return Response()->json(['response' => 'Poste deletado com sucesso!']);
        } 
        return Response()->json(['response' => 'Problema ao deletar'], 405);
    }
}
