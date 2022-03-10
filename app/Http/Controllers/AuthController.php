<?php



namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\Auth\LoginRequest;
use Carbon\Carbon;
use App\Models\User;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login(LoginRequest $request)
    {

        // $credentials = $request->only('email', 'password');
        // $token = JWTAuth::attempt($credentials, ['exp' => Carbon::now()->addYears(10)->timestamp]);
        // try {
        //     if (!$token = JWTAuth::attempt($credentials)) {
        //         return response()->json(['error' => 'invalid_credentials'], 400);
        //     }
        // } catch (\Tymon\JWTAuth\Exceptions\JWTException $ex) {
        //     return response()->json(['error', 'could_not_create_token', 500]);
        // }
        // $user = Auth::user();
        // $user->token = $token;
        // $jsonUser = new UserResource($user);
        // return $jsonUser;

       

        if (!$token = JWTAuth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'errors' => [
                    'email' => ['There is something wrong! We could not verify details']
                ]
            ], 422);
        }

        return (new UserResource($request->user()))
        ->additional([
            'meta' => [
                'token' => $token
            ]
        ]);




        // $credentials = $request->only('email', 'password');
        // if (!$token = JWTAuth::attempt($credentials)) {
        //     return response([
        //         'status' => 'error',
        //         'error' => 'invalid.credentials',
        //         'msg' => 'Invalid Credentials.'
        //     ], 400);
        // }
        // return response([
        //     'status' => 'success'
        // ])
        // ->header('Authorization', $token);

   


        // $credentials = $request->only('email', 'password');
        // if (!$token = Auth::attempt($credentials)) {
        //     return response([
        //         'status' => 'error',
        //         'error' => 'invalid.credentials',
        //         'msg' => 'Invalid Credentials.'
        //     ], 400);
        // }
        // $user = Auth::user();
        // $user->token = $token;
        // $jsonUser = new UserResource($user);
        // return response([
        //     'status' => 'success'
        // ])->header('Authorization', $token);


        

        

        // if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return response()->json([
        //         'message' => 'Dang nhap thanh cong'
        //     ]);
        // }else {
        //     return response()->json([
        //         'message' => 'Tài khoản hoặc mật khẩu không đúng',
        //     ], 401);
        // }
    }

    // public function register(UserRequest $request)
    // {

    //     $userRequest =  $request->all();
    //     $userRequest['password'] = Hash::make($request->password);

    //     $user = $this->userRepository->create($userRequest);
    //     $token = JWTAuth::fromUser($user);
    //     $user->token = $token;
    //     $jsonUser = new UserResource($user);

    //     return $jsonUser;
    // }

    public function register(Request $request)
    {
        // validate dữ liệu
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sex' => $request->sex,
            'address' => $request->address,
            'status' => 1,
            'role' => 0,
            'password' => bcrypt($request->password)
        ]);

        // sau khi lưu dữ liệu user mới vào CSDL, tiến hành đăng nhập luôn rồi trả về token đăng nhập
        if (!$token = JWTAuth::attempt($request->only(['email', 'password', 'phone', 'address', 'sex', 'status', 'role']))) {
            return abort(401);
        }
        return (new UserResource($user))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
        ]);
    }



    // public function permission()
    // {
    //     try {
    //         if (!$user = JWTAuth::parseToken()->authenticate()) {
    //             return response()->json(['user_not_foud'], 400);
    //         }
    //     } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    //         return response()->json(['token_expired'], 500);
    //     } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException  $e) {
    //         return response()->json(['token_invalid'], 500);
    //     } catch (\Tymon\JWTAuth\Exceptions\JWTException  $e) {
    //         return response()->json(['token_absent'], 500);
    //     }
    //     $jsonUser = new UserResource($user);
    //     return $jsonUser = new UserResource($user);;
    // }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(null, 204);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    /**
     * Change Password
     * 
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changePassword(Request $request, $id)
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

    // public function user(Request $request)
    // {

    //     $user = JWTAuth::user();
    //     if (count((array)$user) > 0) {
    //         return response()->json(['status' => 'success', 'user' => $user]);
    //     } else {
    //         return response()->json(['status' => 'fail'], 401);
    //     }

    //     // $user = User::find(JWTAuth::user()->id);
    //     // return response()->json([
    //     //     'status' => 'success',
    //     //     'data' => $user
    //     // ]);
    // }

    public function user()
    {
        return [
            'data' => JWTAuth::parseToken()->authenticate()
        ];
    }

    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
}