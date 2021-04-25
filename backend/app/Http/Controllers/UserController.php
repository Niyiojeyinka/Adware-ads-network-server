<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\PinRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * @OA\Post(
     *      path="/api/pin",
     *      operationId="addpin",
     *      tags={"Pin"},
     *      summary="Create User's Pin",
     *      description="allows user to be able to create pin",
     *      @OA\Parameter(
     *         name="token",
     *         in="query",
     *         description="Token value",
     *         example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRoXC9yZWdpc3RlciIsImlhdCI6MTYxOTAzMjk2MywiZXhwIjoxNjE5MDM2NTYzLCJuYmYiOjE2MTkwMzI5NjMsImp0aSI6IllsMmZ1dGRxaksybWNjcVgiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.ds1SkBXLeFU_cx0EVx8m5l3pc3IBA4_jexYv6TC7yzs",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *   @OA\Parameter(
     *          name="pin",
     *          description="User's 4-digit Pin",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="Error Occurred,check error object",
     *      ),
     *     )
     */

    public function setPin(PinRequest $request)
    {
        if ($request->validator->fails()) {
            return response()->json([
                'result' => 0,
                'message' => 'Error Occurred',
                'data' => [],
                'error' => $request->validator->messages(),
            ], 400);
        }


        $user = auth()->user();
        if (empty($user->pin)) {

            $user = auth()->user();
            $user->update([
                'pin' => Hash::make($request->pin)
            ]);

            return response()->json([
                'result' => 1,
                'message' => 'Pin set successfuly',
                'data' => [],
                'error' => [],
            ], 200);
        } else {

            return response()->json([
                'result' => 0,
                'message' => 'Pin set already',
                'data' => [],
                'error' => [
                    'pin' => ['Pin set already']
                ],
            ], 400);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/profile/{id}",
     *      operationId="viewUser",
     *      tags={"Profile"},
     *      summary="Let you view user's profile",
     *      description="Allow to view user's profile",
     *   @OA\Parameter(
     *          name="id",
     *          description="User id to get user",
     *          required=true,
     *          example=1,
     *          in="path",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *      @OA\Parameter(
     *         name="token",
     *         in="query",
     *         description="Token value",
     *         example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYxOTE2MTA2OCwiZXhwIjoxNjE5MTY0NjY4LCJuYmYiOjE2MTkxNjEwNjgsImp0aSI6InYwaUFvTEdldnI2VlQ4bXIiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.dJx2G6MdbDz4r9SSgDdKpIbBp3gNtuFt1AuvbwQmQoM",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfully Retrieve order",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Error occurred",
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      )
     *
     *     )
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'result' => 0,
                'message' => 'User not found',
                'data' => [
                    'user' => $user,
                ],
            ], 404);
        }

        return response()->json([
            'result' => 1,
            'message' => 'User found',
            'data' => [
                'user' => $user,
            ],
        ], 200);
    }

    /**
     * @OA\Put(
     *      path="/api/profile",
     *      operationId="editProfile",
     *      tags={"Profile"},
     *      summary="Edit user's profile",
     *      description="allows user to be able to edit profile",
     *      @OA\Parameter(
     *         name="token",
     *         in="query",
     *         description="Token value",
     *         example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRoXC9yZWdpc3RlciIsImlhdCI6MTYxOTAzMjk2MywiZXhwIjoxNjE5MDM2NTYzLCJuYmYiOjE2MTkwMzI5NjMsImp0aSI6IllsMmZ1dGRxaksybWNjcVgiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.ds1SkBXLeFU_cx0EVx8m5l3pc3IBA4_jexYv6TC7yzs",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *   @OA\Parameter(
     *          name="phone",
     *          description="User's new phone",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="User's  new Password",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="Error Occurred",
     *      )
     *
     *     )
     */

    public function edit(EditProfileRequest $request)
    {
        $user = auth()->user();
        if ($request->validator->fails()) {
            return response()->json([
                'result' => 0,
                'message' => 'Error Occurred',
                'data' => [],
                'error' => $request->validator->messages(),
            ], 400);
        }
        $validated_data = $request->only(
            'password',
            'phone'
        );

        if (count($validated_data) < 1) {
            return response()->json([
                'result' => 0,
                'message' => 'Missing data values',
                'data' => [],
            ], 400);
        }

        if ($validated_data['password']) {
            $validated_data['password'] = Hash::make($validated_data['password']);
        }

        $user->update($validated_data);
        return response()->json([
            'result' => 1,
            'message' => 'Updated Successfully',
            'data' => [
                'user' => $user->refresh(),
            ],
        ], 200);
    }
}
