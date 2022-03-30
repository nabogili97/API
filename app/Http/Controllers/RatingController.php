<?php

namespace App\Http\Controllers;

use App\Repositories\RatingRepository;
use App\Http\Resources\RatingResource;
use App\Http\Requests\RatingRequest;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * @var Repository
     */
    protected $ratingRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->ratingRepository = new RatingRepository();
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

        $ratings = $this->ratingRepository->search($params);
        $jsonRatings = RatingResource::collection($ratings);

        return $jsonRatings;
    }

    public function list(Request  $request)
    {
        // $params = $request->all();
        // $params['conditions'] = $request->all();

        // $comments = $this->commentRepository->search($params);
        // $jsonComments = CommentResource::collection($comments);

        // return $jsonComments;

        $comment = Rating::with('users')->get();
        return response()->json($comment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Category\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RatingRequest $request)
    {
        $rating = $this->ratingRepository->create($request->all());
        $jsonRating = new RatingResource($rating);

        return $jsonRating;
    }

    public function getRating($id)
    {
        return RatingResource::collection(Rating::all()->where('product_id', $id));
        
        
    }

}
