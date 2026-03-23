<?php

namespace App\Http\Controllers;

use App\Models\UsersJob;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersJobController extends Controller 
{
    use ApiResponser;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Return the list of all jobs
     */
    public function index()
    {
        $usersjob = UsersJob::all();
        return $this->successResponse($usersjob);
    }

    /**
     * Obtain and show one specific job
     */
    public function show($id)
    {
        $usersjob = UsersJob::findOrFail($id);
        return $this->successResponse($usersjob);
    }
}