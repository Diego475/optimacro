<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

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

    /**
     * @OA\Post(
     *      path="/posts",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="title", type="string", example="Title post"),
     *              @OA\Property(property="short_description", type="string", example="Short description post"),
     *              @OA\Property(property="description", type="string", example="Text post"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="create or update",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="true"),
     *          )
     *      )
     * )
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            "id" => "nullable",
            "title" => "required_unless:id,null",
            "short_description" => "required_unless:id,null",
            "description" => "required_unless:id,null",
        ]);

        $data['cover'] = 'https://via.placeholder.com/1000';
        $data['miniature'] = 'https://via.placeholder.com/400';

        if (is_null($request->id)) {
            if (!Post::where()->exists())
                return response()->json(["success" => false, "msg" => "not_fount_post"], 404);

            Post::create($request->all());
        }
        else
            Post::where('id', $request->id)->update($data);

        return response()->json(["success" => true]);
    }
}
