<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;
use Yajra\DataTables\Facades\DataTables;



class PostResourceController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        // If the request is via AJAX (for DataTable)
        if ($request->ajax()) {
            $posts = $this->postService->getAllPosts();
            return DataTables::of($posts)
                ->editColumn('title', function ($post) {
                    return $post->title;
                })
                ->editColumn('description', function ($post) {
                    return $post->description;
                })
                ->editColumn('is_liked', function ($post) {
                    return view('components.liked-component', compact('post'))->render();
                })
                ->addColumn('actions', function ($post) {
                    return view('components.actions', compact('post'))->render();
                })
                ->rawColumns(['actions','is_liked']) // Allow raw HTML for buttons
                ->make(true);
        }

        return view('posts.index');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        // Optionally authorize the action (use Gate if you have defined policies)
        // Gate::authorize('createPost', Post::class);

        try {
            // Validate the request data
            $validatedData = $request->validated();

            // Wrap the operation in a transaction
            $response = DB::transaction(function () use ($validatedData) {
                // Use the service to store the post
                $post = $this->postService->storePost($validatedData);

                // Optionally add a success message (replace Flasher with your notification system if any)
                session()->flash('success', 'Post Created Successfully');

                // Return a JSON response
                return response()->json(['status' => 'success', 'message' => "Post Created Successfully"], 200);
            });

            return $response;
        } catch (\Throwable $th) {
            // Handle errors and optionally show the error message if debug mode is enabled
            $error = config('app.debug') ? $th->getMessage() : "Internal Server Error";
            return response()->json(['status' => 'error', 'error' => $error], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */


    public function edit(string $id)
    {
        $post = $this->postService->getPostById($id); // Assuming a getPostById method in PostService
        return view('posts.edit', compact('post'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, string $id)
    {
        try {
            // Validate the request
            $validatedData = $request->validated();

            // Retrieve the post using the service
            $post = $this->postService->getPostById($id);

            // Update the post using the service
            $this->postService->updatePost($post, $validatedData);

            // Flash a success message
            session()->flash('success', 'Post updated successfully.');

            // Redirect to the index or appropriate page
            return redirect()->route('posts.index');
        } catch (\Exception $e) {
            // Handle errors and optionally log them
            $error = config('app.debug') ? $e->getMessage() : 'Failed to update the post.';
            return redirect()->back()->withErrors(['error' => $error]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = $this->postService->deletePost($id);
    }
}
