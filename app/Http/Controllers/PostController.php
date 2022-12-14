<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @OA\Get(
     *      path="/posts",
     *      @OA\Parameter(
     *          name="limit",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          ),
     *          in="query",
     *          example=6,
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="date",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *          in="query",
     *          example="desc",
     *          required=false,
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          ),
     *          in="query",
     *          example="1",
     *          required=false,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="id", type="integer", example="1"),
     *                  @OA\Property(property="title", type="string", example="Title"),
     *                  @OA\Property(property="description", type="string", example="Description post"),
     *                  @OA\Property(property="short_description", type="string", example="Short description post"),
     *                  @OA\Property(property="deleted_at", type="null", example="null"),
     *                  @OA\Property(property="created_at", type="date", example="2022-10-07T15:57:01.000000Z"),
     *                  @OA\Property(property="updated_at", type="date", example="2022-10-07T15:57:01.000000Z"),
     *                  @OA\Property(property="cover", type="string", example="https://via.placeholder.com/1000"),
     *                  @OA\Property(property="miniature", type="string", example="https://via.placeholder.com/400"),
     *              ),
     *          ),
     *      ),
     *  )
     */

    public function index(Request $request)
    {
        if ($request->page) 
            $posts = Post::paginate($request->limit);
        else 
            $posts = Post::filter($request)->sorting($request)->get();

        return $posts;
    }

    /**
     * @OA\Get(
     *      path="/posts/{id}",
     *      @OA\Parameter(
     *          name="id",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          in="path",
     *          example="1",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *                  @OA\Property(property="id", type="integer", example="1"),
     *                  @OA\Property(property="title", type="string", example="Title"),
     *                  @OA\Property(property="description", type="string", example="Description post"),
     *                  @OA\Property(property="short_description", type="string", example="Short description post"),
     *                  @OA\Property(property="deleted_at", type="null", example="null"),
     *                  @OA\Property(property="created_at", type="date", example="2022-10-07T15:57:01.000000Z"),
     *                  @OA\Property(property="updated_at", type="date", example="2022-10-07T15:57:01.000000Z"),
     *                  @OA\Property(property="cover", type="string", example="https://via.placeholder.com/1000"),
     *                  @OA\Property(property="miniature", type="string", example="https://via.placeholder.com/400"),
     *          ),
     *      ),
     *  )
     */

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) 
            return response()->json(["success" => false, "msg" => "not_found_post"], 404);

        return $post;
    }
}
