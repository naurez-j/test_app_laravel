<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUserRequest;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request as HttpRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    protected UserServices $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }

    public function getData(HttpRequest $request)
    {
        $usersData = $this->userServices->getData($request);
        return $usersData;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        try {
            $validatedData = $request->validated();

            $response = DB::transaction(function () use ($validatedData) {
                $user = $this->userServices->storeUser($validatedData);
                Flasher::addSuccess("User Created Successfully");
                return response()->json(['status' => 'success', 'message' => "User Created Successfully"], 200);
            });

            return $response;
        } catch (\Throwable $th) {
            $error = config('app.debug') == true ? $th->getMessage() : "Internal Server Error";
            return response()->json(['status' => 'error', 'error' => $error], 500);
        }

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
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
