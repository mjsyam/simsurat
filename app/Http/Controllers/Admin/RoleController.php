<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Utils\ErrorHandler;
use App\Constants;
use App\Models\User;

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
                    $role = $query->name;

                    return view('admin.role.components.menu', compact(['role']));
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $role)
    {
        //
        $role = Role::findOrFail($role)->get();
        $not_assigned_users = User::whereDoesntHave('userRoles', function ($query) use ($role) {
            $query->where('role_id', $role);
        })->get();

        $user = User::role($role)->get();
        return view('admin.role.detail', compact(['role', 'not_assigned_users', 'user']));
    }

    public function assignUser(Request $request, string $role)
    {
        $request->validate([
            'user_id' => 'required|string',
        ]);

        User::whereId($request->user_id)->assignRole($role);

       return redirect()->route('admin.role.detail', $role);
    }

    public function removeUser(Request $request, string $role)
    {
        $request->validate([
            'user_id' => 'required|string',
        ]);

        User::whereId($request->user_id)->removeRole($role);

        return redirect()->route('admin.role.detail', $role);
    }
}
