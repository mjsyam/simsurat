<?php

namespace App\Http\Controllers\Admin;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Identifier;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use App\Models\ModelHasRole;
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

        $identifiers = $unit->identifiers()->get();

        $roles = Role::whereDoesntHave('identifiers', function ($query) use ($unit) {
            $query->where('unit_id', $unit->id);
        })->get();

        return view('admin.unit.detail', compact(['unit', 'roles', 'identifiers']));
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

    public function assignIdentifier(Request $request, $unit)
    {
        $request->validate([
            'role_id' => 'required|string',
        ]);

        Identifier::create([
            'unit_id' => $unit,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.unit.detail', $unit);
    }

    public function removeIdentifier(Request $request, string $unit)
    {
        $request->validate([
            'role_id' => 'required|string',
        ]);

        $identifier = Identifier::where('unit_id', $unit)->where('role_id', $request->role_id)->firstOrFail();
        $identifier->delete();

        return redirect()->route('admin.unit.detail', $unit);
    }
}
