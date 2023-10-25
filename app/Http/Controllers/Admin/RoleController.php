<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Utils\ErrorHandler;
use App\Constants;
use App\Models\Identifier;
use App\Models\Unit;
use App\Models\User;
use App\Models\Role;

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
            $query = Role::with('parent')->orderBy('created_at', 'desc');

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
                ->addColumn('parent', function ($query) {
                    $parent = $query->parent->name ?? '-';

                    return $parent;
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

        $identifiers = $role->identifiers()->get();

        $units = Unit::whereDoesntHave('identifiers', function ($query) use ($id) {
            $query->where('role_id', $id);
        })->get();

        return view('admin.role.detail', compact(['role', 'identifiers', 'units']));
    }

    public function assignIdentifier(Request $request, string $role)
    {
        $request->validate([
            'unit_id' => 'required|string',
        ]);

        Identifier::create([
            'unit_id' => $request->unit_id,
            'role_id' => $role,
        ]);


        return redirect()->route('admin.role.detail', $role);
    }

    public function removeIdentifier(Request $request, string $id)
    {
        $request->validate([
            'unit_id' => 'required|string',
        ]);

        $identifier = Identifier::where('unit_id', $request->unit_id)->where('role_id', $id)->firstOrFail();

        $identifier->delete();


        return redirect()->route('admin.role.detail', $id);
    }
}
