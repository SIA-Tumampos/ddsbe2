<?php  

namespace App\Http\Controllers;
use App\Models\UsersJob;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

Class UserController extends Controller
{
    use ApiResponser;
    private $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function GetUsers()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function index()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function add(Request $request)
    {
        $rules = [
            'username' => 'required|string|unique:users,username|max:50',
            'password' => 'required|string|min:6|max:20',
            'jobid' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request, $rules);

        $userjob = UsersJob::findOrFail($request->jobid);

        $user = User::create($request->all());
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        if(!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse($user);
    }

    public function update($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        if(!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $rules = [
            'username' => 'string|unique:users,username|max: 50',
            'password' => 'string|min:6|max:20',
            'jobid' => 'numeric|min:1|not_in:0',
        ];

        $this->validate($request, $rules);
        $userjob = UsersJob::findOrFail($request->jobid);

        $user->update($request->all());
        return $this->successResponse($user);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        }
        return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);

    }

}