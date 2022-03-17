<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * @var Repository
     */
    protected $brandRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    /**
     * Find data by multiple fields.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();

        $posts = $this->postRepository->search($params);
        $jsonPosts = PostResource::collection($posts);

        return $jsonPosts;
    }

    // /**
    //  * Get list category with status = 1
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function listPost(Request  $request)
    // {
    //     $params = $request->all();
    //     $params['conditions'] = $request->all();
    //     $params['conditions']['status'] = Brand::BRAND_ENABLED;

    //     $brands = $this->brandRepository->search($params);
    //     $jsonBrands = BrandResource::collection($brands);

    //     return $jsonBrands;
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Category\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(BrandRequest $request)
    // {
    //     $brand = $this->brandRepository->create($request->all());
    //     $jsonBrand= new BrandResource($brand);

    //     return $jsonBrand;
    // }

    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->public_start_at = $request->public_start_at;
        $post->public_end_at = $request->public_end_at;
        $post->description = $request->description;
        $post->status = $request->status;
        if ($request->image) {
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $name = 'post/images/' . $image->getClientOriginalName();

            $target_dir    = "post/images/";
            $target_file   = $target_dir . basename($_FILES["image"]["name"]);

            $post->image = $target_file;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "File " . basename($_FILES["image"]["name"]) .
                    " Đã upload thành công.";

                echo "File lưu tại " .
                    $target_file;
            }


            $post->image = $name;
        } else {
            $post->image = 'defaul.jpg';
        }
        $post->save();
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
            $post = $this->postRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonPost = new PostResource($post);

        return $jsonPost;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Category\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->public_start_at = $request->public_start_at;
        $post->public_end_at = $request->public_end_at;
        $post->description = $request->description;
        $post->status = $request->status;
        if ($request->image) {
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $name = 'post/images/' . $image->getClientOriginalName();

            $target_dir    = "post/images/";
            $target_file   = $target_dir . basename($_FILES["image"]["name"]);

            $post->image = $target_file;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "File " . basename($_FILES["image"]["name"]) .
                    " Đã upload thành công.";

                echo "File lưu tại " .
                    $target_file;
            }

            $post->image = $name;
        }
        $post->save();
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
            $post = $this->postRepository->update($request->only('status'), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonPost= new PostResource($post);

        return $jsonPost;
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
            $result = $this->postRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }
}
