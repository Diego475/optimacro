<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * @OA\Delete(
     *      path="/posts/{id}",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Delete post",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="true"),
     *          )
     *      ),
     * )
     */
    public function delete($id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->delete();
            return response()->json(["success" => true]);
        }

        return response()->json(["success" => false, "msg" => "not_found_post"], 403);
    }
}
