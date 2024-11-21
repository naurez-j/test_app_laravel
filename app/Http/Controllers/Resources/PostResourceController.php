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
        if ($request->ajax()) {
            try {
                $posts = $this->postService->getAllPosts();

                // Ensure DataTables is being fed correctly formatted data
                return DataTables::of($posts)
                    ->addColumn('action', function ($row) {
                        return '<a href="' . route('posts.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>';
                    })
                    ->make(true);
            } catch (\Exception $e) {
                // Log the error and send it as JSON for debugging
                //Log::error('Error in DataTable: ' . $e->getMessage());
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
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
        return view('posts.edit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
