<?php


namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var Repository
     */
    protected $userRepository;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
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

        $users = $this->userRepository->search($params);
        $jsonUsers = UserResource::collection($users);

        return $jsonUsers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\GroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->userRepository->create($request->all());
        $jsonUser = new UserResource($user);

        return $jsonUser;
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
            $user = $this->userRepository->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonUser = new UserResource($user);

        return $jsonUser;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\User\UpdateUserPasswordRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPasswordRequest $request, $id)
    // public function update(UserRequest $request, $id)
    {
        try {
            $user = $this->userRepository->update($request->all(), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonUser = new UserResource($user);

        return $jsonUser;
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
            $user = $this->userRepository->update($request->only('status'), $id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        $jsonUser = new UserResource($user);

        return $jsonUser;
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
            $result = $this->userRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }

        return response($result);
    }
}