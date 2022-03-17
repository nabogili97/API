<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use App\Http\Resources\CommentResource;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @var Repository
     */
    protected $commentRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
    }

    /**
     * Find data by multiple fields.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();

        $comments = $this->commentRepository->search($params);
        $jsonComments = CommentResource::collection($comments);

        return $jsonComments;
    }

    /**
     * Get list category with status = 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listCategory(Request  $request)
    {
        $params = $request->all();
        $params['conditions'] = $request->all();

        $comments = $this->commentRepository->search($params)::paginate(5);
        $jsonComments = CommentResource::collection($comments);

        return $jsonComments;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Category\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $comment = $this->commentRepository->create($request->all());
        $jsonComment = new CommentResource($comment);

        return $jsonComment;
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
            $category = $this->commentRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonComment = new CommentResource($category);

        return $jsonComment;
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
        try {
            $comment = $this->categoryRepository->update($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonComment = new CommentResource($comment);

        return $jsonComment;
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
            $result = $this->commentRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }
}
