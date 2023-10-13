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
    public function show($role)
    {
        //
        $role = Role::where('name',$role)->first();
        $units = Unit::with('parent')->get();

        $users = User::with('roles.unit')->whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role->name);
        })->get();
        $user_ids = $users->pluck('id');

        $not_assigned_users = User::whereNotIn('id', $user_ids)->get();
        return view('admin.role.detail', compact(['role', 'not_assigned_users', 'users', 'units']));
    }

    public function assignUser(Request $request, string $role)
    {
        $request->validate([
            'user_id' => 'required|string',
            'unit_id' => 'required|string',
        ]);

        $user = User::findOrFail($request->user_id)->assignRole($role);
        $user->roles()->where('name', $role)->first()->pivot->update([
            'unit_id' => $request->unit_id
        ]);

       return redirect()->route('admin.role.detail', $role);
    }

    public function removeUser(Request $request, string $role)
    {
        $request->validate([
            'user_id' => 'required|string',
        ]);


        $user = User::findOrFail($request->user_id)->removeRole($role);
        
        return redirect()->route('admin.role.detail', $role);
    }
}
