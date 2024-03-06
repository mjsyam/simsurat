<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Constants;
use App\Exceptions\NotFoundError;
use App\Models\Identifier;
use App\Models\Role;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Svg\Tag\Rect;
use Illuminate\Support\Facades\Auth;

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

        $unit = Unit::all();

        return view('admin.user.index', compact([
            'userStatus', 'unit'
        ]));
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
                    return view('admin.user.components.menu', compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'number' => 'required|string',
                'phone_number' => 'string|nullable', // 'phone_number' => 'required|string|unique:users,phone_number
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|min:8',
                'status' => ['nullable', Rule::in($this->constants->user_status)],
                'unit_id' => 'required|min:1|exists:units,id',
                'signature' => 'string|nullable',
                'avatar' => 'string|nullable',
            ]);

            $data = $request->all();

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $user = User::create([
                "unit_id" => $request->unit_id,
                "name" => $request->name,
                "number" => $request->number,
                "phone_number" => $request->phone_number,
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
        $user = User::with('identifiers')->whereId($id)->first();

        $identifiers = Identifier::all();


        return view('admin.user.detail', compact(['user', 'identifiers']));
    }

    public function update(Request $request)
    {
        try {
            $user = User::whereId($request->id)->first();

            if (!$user) {
                throw new NotFoundError("User tidak ditemukan");
            }

            $request->validate([
                'name' => 'required|string',
                'number' => 'required|string',
                "phone_number" => "nullable|string", // "phone_number" => "required|string|unique:users,phone_number,$user->id",
                'email' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
                'status' => ['nullable', Rule::in($this->constants->user_status)],
            ]);

            $user->update([
                "name" => $request->name,
                "number" => $request->number,
                "phone_number" => $request->phone_number,
                "email" => $request->email,
                "status" => $request->status
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil melakukan edit user",
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);


            if (!$user) {
                throw new NotFoundError("User tidak ditemukan");
            }

            $user->identifiers()->detach();

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

    public function assignIdentifier(Request $request)
    {
        $user = User::findOrFail($request->id);

        $request->validate([
            'identifiers' => 'required|array|exists:identifiers,id',
        ]);

        $user->identifiers()->sync($request->identifiers);

        return redirect()->route('admin.user.detail', $request->id);
    }
}
