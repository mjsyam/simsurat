<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Utils\ErrorHandler;
use App\Constants;
use App\Models\User;
use App\Models\UserRole;

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
                    $roleId = $query->id;

                    return view('admin.role.components.menu', compact(['roleId']));
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $role = Role::with('userRoles')->findOrFail($id);
        $not_assigned_users = User::whereDoesntHave('userRoles', function ($query) use ($id) {
            $query->where('role_id', $id);
        })->get();
        return view('admin.role.detail', compact(['role', 'not_assigned_users']));
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

    public function assignUser(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|string',
        ]);
        
        $userRole = UserRole::create([
            'user_id' => $request->user_id,
            'role_id' => $id,
            'identifier_id' => '1'
        ]);

       return redirect()->route('admin.role.detail', $id);
    }

    public function removeUser(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|string',
        ]);

        $userRole = UserRole::where('user_id', $request->user_id)->where('role_id', $id)->first();
        $userRole->delete();

        return redirect()->route('admin.role.detail', $id);
    }
}
