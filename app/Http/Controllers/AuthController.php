<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/login",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string")
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="get token",
     *          @OA\JsonContent(
     *              @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTRhZTcxZGIyODEzZDgwY2NjZWE5MTMzZDhjOGRjNjc3NTlkZGVmODRlMTFmMjkzMTE5MjFmOTQ4ZTRjZjZhMjBiM2I2OTYyNDA2ZmE3MmQiLCJpYXQiOjE2NjU0MDgxNDMsIm5iZiI6MTY2NTQwODE0MywiZXhwIjoxNjk2OTQ0MTQzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.WZWIYrReYym6Ea4RmYhWaIIbyH3vrf485h5dda1tiuCmpoVNf6T_wdaf1ww2cutSlHG6KD97Q7py1Eoe1fVUjwbzUWMNewuIMLHziELHS5TLkkJRv19LIccMVwTUK0BZvq_LtYVZ3Qox9vbcyfGK4mjqIiXyeha6TZSuqaqjMQhTFChV4WKrS1tmCGH_yrEy9DlT-8kwWS5Ty_647Gigo9Ti6HRJyqVMy_OtNvR5zj_0azOp2o99xCYWyP_MYUTgaQatEAYedtN3HWYHzSpCHLA1OK3PAoLNVC_mEu4JFtjc5X-Gj72bY2KUMYzASWcxPVtIplhva9AvfNE3TxNyTcH_wjpyTGmLY54-lA60EWMugRRUu2kKMCQu1lk_GV5F4S2p88BR_o-s2i7hzm4SrO5SUMvbUWoxR-1GIp6BrCSNU-zeXp4GITudFzNUXpb_-a7Jd5b1p9Kz_o6QS5ij4mAPPP0xmkz0vjrvqDUdv2ZyQl2iev9P0LB53y3fcF01Uagrl4pLJj31vMdLzjAfcv4AzeSx5LfImWNgQJddBoIIdd-xbUm3Is_PuJdJ2xPefgp24gDBd5LnTzvzwcPW8AXltiWLLL_5eCm7YKkv74Nvas8IXyY7hZeaLkqH4OPGERHmmYnOmxdwwKAzK2DlPqyQWM1PSK4knSDfh6WGLSA"),
     *              @OA\Property(property="user", type="object", 
     *                  @OA\Property(property="id", type="integer", example=1),
     *                  @OA\Property(property="email", type="email", example="example@mail.ru"),
     *                  @OA\Property(property="deleted_at", type="null", example=null),
     *                  @OA\Property(property="created_at", type="string", example="2022-10-10T12:25:51.000000Z"),
     *                  @OA\Property(property="updated_at", type="string", example="2022-10-10T12:25:51.000000Z"),
     *              ),
     *          ),
     *      ),
     *    )
     *
    */

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:8"
        ]);

        $user = User::where('email', $request->email);
        if (!$user->exists())
            return response()->json(["success" => false, "msg" => "user_not_found"], 403);
        

        $hash = Hash::check($request->password, $user->first()->password);
        if (!$hash)
            return response()->json(["success" => false, "msg" => "invalid_password"], 403);

        $user = $user->first();
        return response()->json([
            "token" => $user->createToken("optimacro")->accessToken,
            "user" => $user
        ]);
    }
}
