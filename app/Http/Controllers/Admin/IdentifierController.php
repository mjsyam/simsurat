<?php

namespace App\Http\Controllers\Admin;

use App\Utils\ErrorHandler;
use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Identifier;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use App\Models\UserIdentifier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IdentifierController extends Controller
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
        $identifiers = Identifier::all();

        $roles = Role::all();
        $units = Unit::all();
        return view('admin.identifier.index', compact(['identifiers', 'roles', 'units']));
    }

    public function getIdentifiersTable()
    {
        if (request()->ajax()) {
            $query = Identifier::with('role', 'unit')->orderBy('created_at', 'desc');

            return DataTables::of($query)
                ->addColumn('action', function ($query) {
                    $identifier = $query->id;

                    return view('admin.identifier.components.menu', compact(['identifier']));
                })
                ->addColumn('role', function ($query) {
                    $role = $query->role->name ?? '-';

                    return $role;
                })
                ->addColumn('unit', function ($query) {
                    $unit = $query->unit->name ?? '-';

                    return $unit;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    public function show($identifier)
    {
        $identifier = Identifier::with('users')->findOrFail($identifier);

        $assigned_users = $identifier->users()->get();

        $assigned_user_id = $assigned_users->pluck('id')->toArray();

        $unassigned_users = User::whereNotIn('id', $assigned_user_id)->get();


        return view('admin.identifier.detail', compact(['identifier', 'assigned_users', 'unassigned_users']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|string|exists:roles,id||unique:identifiers,role_id,NULL,id,unit_id,' . $request->unit_id,
            'unit_id' => 'required|string|exists:units,id|unique:identifiers,unit_id,NULL,id,role_id,' . $request->role_id,
        ]);

        Identifier::create([
            'role_id' => $request->role_id,
            'unit_id' => $request->unit_id,
        ]);

        return redirect()->back()->with('success', 'Unit berhasil ditambahkan');
    }

    public function destroy(Request $request)
    {
        try {
            $identifier = Identifier::findOrFail($request->id);
            $identifier->users()->detach();
            $identifier->delete();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil Menghapus Identifier :" . $identifier->role->name . " - " . $identifier->unit->name,
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function assignUser(Request $request, $unit)
    {
        // $request->validate([
        //     'role_id' => 'required|string',
        // ]);
        

        UserIdentifier::create([
            'user_id' => $request->user_id,
            'identifier_id' => $unit,
        ]);

        return redirect()->route('admin.identifier.detail', $unit);
    }

    public function removeUser(Request $request, string $unit)
    {
        // $request->validate([
        //     'role_id' => 'required|string',
        // ]);

        $user_indentifier = UserIdentifier::where('user_id', $request->user_id)->where('identifier_id', $unit)->first();
        $user_indentifier->delete();

        return redirect()->route('admin.identifier.detail', $unit);
    }
}
