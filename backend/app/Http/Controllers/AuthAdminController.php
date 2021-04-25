<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;

class AuthAdminController extends Controller
{
    //

    /**
     * @OA\Post(
     *      path="/api/admin/login",
     *      operationId="authadminsignin",
     *      tags={"Admin"},
     *      summary="Sign in the admin",
     *      description="allow admin to be able to sign in returns data object with token",
     *   @OA\Parameter(
     *          name="email",
     *          description="Admin's Email Address",
     *          required=true,
     *          in="query",
     *          example="now@gmail.com",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Admin's Password",
     *          required=true,
     *          in="query",
     *          example="babatunde",
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
    public function login(AdminLoginRequest $request)
    {
        if ($request->validator->fails()) {
            return response()->json([
                'result' => 0,
                'message' => 'Error Occurred',
                'data' => [],
                'error' => $request->validator->messages(),
            ], 401);
        }

        $credentials = request(['email', 'password']);

        if (!$token = auth()->guard('admin')->attempt($credentials)) {
            return response()->json([
                'result' => 0,
                'error' => 'Unauthorized',
            ], 401);
        }

        return $this->respondWithToken($token);
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
            'message' => 'Admin Sign in successfully',
            'data' => [
                'token' => $token,
                'user' => auth()->guard('admin')->user(),
                'token_type' => 'bearer',
                'expires_in' => auth()->guard('admin')->factory()->getTTL() * 60,
            ],
        ], $status);
    }
}
