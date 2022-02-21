<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();

        try {
            $response = $this->postRepository->search($params);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = PostResource::collection($response);

        return  $jsonSetting;
    }

    /**
     * Get list post with status = 1
     *
     * @return \Illuminate\Http\Response
     */
    public function listPost(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();
        $params['conditions']['status'] = Post::STATUS_POST_ENABLED;
        $params['isContent'] = true;
        try {
            $response = $this->postRepository->search($params);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = PostResource::collection($response);
        return  $jsonSetting;
    }

    /**
     * Get list post popular
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getListPopular(Request $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();
        $params['conditions']['status'] = Post::STATUS_POST_ENABLED;
        try {
            $response = $this->postRepository->getListPopular($params);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = PostResource::collection($response);
        return $jsonSetting;
    }

    /**
     * Get list post new
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getListNew(Request $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();
        $params['conditions']['status'] = Post::STATUS_POST_ENABLED;
        try {
            $response = $this->postRepository->getListNew($params);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = PostResource::collection($response);
        return $jsonSetting;
    }

    /**
     * Get list post radom
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getListRadom()
    {
        try {
            $response = $this->postRepository->getListRadom();
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = PostResource::collection($response);
        return $jsonSetting;
    }

    /**
     * Store post
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            $response = $this->postRepository->store($request->all());
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = new PostResource($response);
        return $jsonSetting;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $response  = $this->postRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = new PostResource($response);
        return $jsonSetting;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Thing\SettingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        try {
            $response = $this->postRepository->updatePost($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = new PostResource($response);
        return $jsonSetting;
    }

    /**
     * Update Status.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $response = $this->postRepository->update($request->only('status'), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonSetting = new PostResource($response);

        return $jsonSetting;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $response  = $this->postRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($response);
    }
}
