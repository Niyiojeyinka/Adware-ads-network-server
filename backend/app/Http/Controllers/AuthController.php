<?php

namespace App\Http\Controllers;

use App\Events\UserForgetPassword;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{

    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      operationId="authsignin",
     *      tags={"Authentication"},
     *      summary="Sign in to user's dashboard",
     *      description="allow user to be able to sign in returns data object with token",
     *   @OA\Parameter(
     *          name="email",
     *          description="Users Email Address",
     *          required=true,
     *          in="query",
     *          example="olaniyiojeyinka@gmail.com",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="User's Password",
     *          required=true,
     *          in="query",
     *          example="test",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     *
     *     )
     */
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'result' => 0,
                'error' => 'Unauthorized',
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Get(
     *      path="/api/auth/logout",
     *      operationId="authlogout",
     *      tags={"Authentication"},
     *      summary="Sign out of user's dashboard",
     *      description="allow user to be able to sign out",
     *      @OA\Parameter(
     *         name="token",
     *         in="query",
     *         description="Token value",
     *         example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYxODk5OTQ5OCwiZXhwIjoxNjE5MDAzMDk4LCJuYmYiOjE2MTg5OTk0OTgsImp0aSI6IjRZdjlCTGdxVUhBZGpHM1kiLCJzdWIiOjgsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.yjNvT61ON8zeFwS2XUPHHXbsxYC2r6ABwbRQK3LVDH4",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *
     *     )
     */

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'result' => 1,
            'data' => [],
            'message' => 'Successfully logged out',
        ], 200);
    }

    /**
     * @OA\Get(
     *      path="/api/auth/refresh",
     *      operationId="authrefresh",
     *      tags={"Authentication"},
     *      summary="Refresh user token",
     *      description="allow user to be able to refresh token",
     *      @OA\Parameter(
     *         name="token",
     *         in="query",
     *         description="Token value",
     *         example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYxODk5OTQ5OCwiZXhwIjoxNjE5MDAzMDk4LCJuYmYiOjE2MTg5OTk0OTgsImp0aSI6IjRZdjlCTGdxVUhBZGpHM1kiLCJzdWIiOjgsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.yjNvT61ON8zeFwS2XUPHHXbsxYC2r6ABwbRQK3LVDH4",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *
     *     )
     */

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $status = 200)
    {

        return response()->json([
            'result' => 1,
            'message' => 'Sign in sucessfuly',
            'data' => [
                'token' => $token,
                'user' => auth()->user(),
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ],
        ], $status);
    }

    /**
     * @OA\Post(
     *      path="/api/auth/register",
     *      operationId="authregister",
     *      tags={"Authentication"},
     *      summary="Register new user account",
     *      description="allow user to be able to sign up",
     *   @OA\Parameter(
     *          name="email",
     *          description="Users Email Address",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="User's Password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="firstname",
     *          description="User's Firstname",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="lastname",
     *          description="User's lastname",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="middlename",
     *          description="User's middlename",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Error occurred",
     *      )
     *
     *     )
     */
    public function register(RegisterRequest $request)
    {
        if ($request->validator->fails()) {
            return response()->json([
                'result' => 0,
                'message' => 'Error Occurred',
                'data' => [],
                'error' => $request->validator->messages(),
            ], 400);
        }
        $user = User::create(
            array_merge($request->all(), [
                'password' => Hash::make($request->password),
                'account_no' => $this->generateAccountNo(),
                'role_id' => 1,
            ])

        );

        Account::create([
            'user_id' => $user->id,
            'balance' => 0,
        ]);
        $token = auth()->login($user);

        return $this->respondWithToken($token, 201);
    }

    /**
     * @OA\Post(
     *      path="/api/auth/forget",
     *      operationId="authforget",
     *      tags={"Authentication"},
     *      summary="Request for token email to reset password",
     *      description="Request for token email to reset password",
     *   @OA\Parameter(
     *          name="email",
     *          description="Users Email Address",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Error occurred",
     *      )
     *
     *     )
     */

    public function forget_password(ForgetPasswordRequest $request)
    {
        if ($request->validator->fails()) {
            return response()->json([
                'result' => 0,
                'message' => 'Error Occurred',
                'data' => [],
                'error' => $request->validator->messages(),
            ], 400);
        }
        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            return response()->json([
                'result' => 0,
                'message' => 'Error Occurred',
                'data' => [],
                'error' => [
                    'email' => ['Account not exists'],
                ],
            ], 400);
        } else {
            $recoveryToken =  mt_rand(1000000, 9000000) . $user->id;

            $user->update([
                'recovery_token' => $recoveryToken,
            ]);
        }

        event(new UserForgetPassword([
            'token' => $recoveryToken,
            'user' => $user,
        ]));
        return response()->json([
            'result' => 1,
            'message' => 'Successfuly sent recovery email',
            'data' => [],

        ], 200);
    }

    /**
     * @OA\Post(
     *      path="/api/auth/reset",
     *      operationId="authreset",
     *      tags={"Authentication"},
     *      summary="reset password with token from email",
     *      description="Reset password with token from email",
     *   @OA\Parameter(
     *          name="token",
     *          description="Token sent to email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *   @OA\Parameter(
     *          name="password",
     *          description="New Account Password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Error occurred",
     *      )
     *
     *     )
     */
    public function reset(ResetPasswordRequest $request)
    {
        if ($request->validator->fails()) {
            return response()->json([
                'result' => 0,
                'message' => 'Error Occurred',
                'data' => [],
                'error' => $request->validator->messages(),
            ], 400);
        }

        User::where(
            'recovery_token',
            $request->token
        )->update([
            'password' => Hash::make($request->password),
            'recovery_token' => null,
        ]);

        return response()->json([
            'result' => 1,
            'message' => 'Successfuly changed password',
            'data' => [],

        ], 200);
    }
}
