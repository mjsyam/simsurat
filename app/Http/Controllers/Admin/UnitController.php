<?php

namespace App\Http\Controllers\Admin;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    //

    private $constants;
    private $errorHandler;

    public function __construct()
    {
        $this->constants = new Constants();
        $this->errorHandler = new ErrorHandler();
    }

    public function index()
    {
        $units = Unit::all();
        return view('admin.unit.index', compact(['units']));
    }

    public function getUnitsTable()
    {
        if (request()->ajax()) {
            $query = Unit::with('parent')->orderBy('created_at', 'desc');

            return DataTables::of($query)
                // ->addColumn('created_at', function ($query) {
                //     $date = explode(" ", explode("T", $query->created_at)[0])[0];

                //     $date = Carbon::createFromFormat('Y-m-d', $date);
                //     $formattedDate = $date->format('d-m-Y');

                //     return $formattedDate;
                // })
                ->addColumn('action', function ($query) {
                    $unit = $query->id;

                    return view('admin.unit.components.menu', compact(['unit']));
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

    public function show($unit)
    {
        $unit = Unit::find($unit);
        $roles = Role::all();

        $users = $unit->users;
        $user_ids = $users->pluck('id')->toArray();

        $not_assigned_users = User::whereNotIn('id', $user_ids)->get();


        return view('admin.unit.detail', compact(['unit', 'roles', 'users', 'not_assigned_users']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable',
        ]);

        Unit::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'Unit berhasil ditambahkan');
    }

    public function update(Request $request, $unit)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|exists:units,id',
        ]);

        $unit = Unit::find($unit);
        $unit->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'Unit berhasil diubah');
    }

    public function destroy($unit)
    {
        $unit = Unit::find($unit);
        $unit->delete();

        return redirect()->back()->with('success', 'Unit berhasil dihapus');
    }

    public function assignUser(Request $request, string $unit)
    {
        $request->validate([
            'user_id' => 'required|string',
            'role' => 'required|string',
        ]);

        $user = User::with('roles.unit')->findOrFail($request->user_id)->assignRole($request->role);
        $user->roles()->where('name', $request->role)->first()->pivot->update([
            'unit_id' => $unit
        ]);

        return redirect()->route('admin.unit.detail', $unit);
    }

    public function removeUser(Request $request, string $unit)
    {
        $request->validate([
            'user_id' => 'required|string',
        ]);

        $user = User::with([
            'roles.unit' => function ($query) use ($unit) {
                $query->where('unit_id', $unit);
            }
        ])->findOrFail($request->user_id);

        $user->removeRole($user->roles[0]->name);
        return redirect()->route('admin.unit.detail', $unit);
    }
}
