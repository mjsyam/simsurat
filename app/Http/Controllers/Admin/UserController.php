<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Constants;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $constants;
    private $errorHandler;

    public function __construct()
    {
        $this->constants = new Constants();
        $this->errorHandler = new ErrorHandler();
    }

    public function index()
    {
        $userStatus = $this->constants->user_status;
        return view('admin.user.index', compact(['userStatus']));
    }

    public function getUsersTable()
    {
        if (request()->ajax()) {
            $query = User::orderBy('created_at', 'desc');

            return DataTables::of($query)
                ->addColumn('created_at', function ($query) {
                    $date = explode(" ", explode("T", $query->created_at)[0])[0];

                    $date = Carbon::createFromFormat('Y-m-d', $date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('action', function ($query) {
                    $userId = $query->id;

                    return view('admin.user.components.menu', compact(['userId']));
                })
                ->addIndexColumn()
                ->rawColumns(['action','DT_RowChecklist'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'string',
                'email' => 'string|unique:users,email',
                'password' => 'string|min:8',
                'status' => ['nullable', Rule::in($this->constants->user_status)],
                'signature' => 'string|nullable',
                'avatar' => 'string|nullable',
            ]);

            $data = $request->all();

            if (isset($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }

            User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($data['password']),
                "signature" => $request->signature,
                "avatar" => $request->avatar,
                "status" => $request->status
            ]);

            return response()->json([
                "status" => "success",
                "message" => "berhasil menambah user"
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function show(string $id)
    {
        $user = User::whereId($id)->first();

        return view('admin.user.detail', compact(['user']));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'string|nullable',
            'email' => 'string|nullable',
            'status' => 'string|nullable',
            'password' => 'string|nullable|min:8|confirmed',
            'signature' => 'string|nullable',
            'avatar' => 'string|nullable',
        ]);

        $user = User::findOrFail($id);

        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']); // Hash the password
        }
        $user->update($data);

        return response()->json($request);
    }

    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil Menghapus User $user->name"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
