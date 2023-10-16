<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Utils\ErrorHandler;
use App\Constants;
use App\Models\Unit;
use App\Models\User;
use App\Models\ModelHasRole;

class RoleController extends Controller
{
    private $constants;
    private $errorHandler;

    public function __construct()
    {
        $this->constants = new Constants();
        $this->errorHandler = new ErrorHandler();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.role.index');
    }

    public function getRolesTable()
    {
        if (request()->ajax()) {
            $query = Role::orderBy('created_at', 'desc');

            return DataTables::of($query)
                // ->addColumn('created_at', function ($query) {
                //     $date = explode(" ", explode("T", $query->created_at)[0])[0];

                //     $date = Carbon::createFromFormat('Y-m-d', $date);
                //     $formattedDate = $date->format('d-m-Y');

                //     return $formattedDate;
                // })
                ->addColumn('action', function ($query) {
                    $role = $query->id;

                    return view('admin.role.components.menu', compact(['role']));
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Role::create([
            "name" => $request->name,
        ]);

        return redirect()->route('admin.role.index');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $role = Role::findOrFail($id);

        $users = User::with('roles.unit')->whereHas('roles', function ($query) use ($role) {
            $query->where('id', $role->id);
        })->get();
        $user_ids = $users->pluck('id');

        $units = Unit::all();

        $not_assigned_users = User::whereNotIn('id', $user_ids)->get();
        return view('admin.role.detail', compact(['role', 'not_assigned_users', 'users', 'units']));
    }

    public function assignUser(Request $request, string $role)
    {
        $request->validate([
            'user_id' => 'required|string',
            'unit_id' => 'required|string',
        ]);

        ModelHasRole::create([
            "role_id" => $role,
            "unit_id" => $request->unit_id,
            "model_type" => "App\Models\User",
            "model_id" => $request->user_id
        ]);


        return redirect()->route('admin.role.detail', $role);
    }

    public function removeUser(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|string',
        ]);


        $role = Role::findOrFail($id);
        User::findOrFail($request->user_id)->removeRole($role->name);

        return redirect()->route('admin.role.detail', $role->id);
    }
}
