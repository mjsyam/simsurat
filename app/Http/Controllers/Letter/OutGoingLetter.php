<?php
namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Models\Letter;
use App\Models\Role;

class OutGoingLetter extends Controller
{
    public function index()
    {
        return view("outgoing-letter.index");
    }
    public function tableApprove()
    {
        if (request()->ajax()) {
            $user = Auth::user();
            $roleIds = $user->identifiers->first()->role->pluck('id')->toArray();
            $childRoleIds = array_unique($this->getChildRoleIds($roleIds));

            $letters = Letter::where(function ($query) use ($childRoleIds) {
                $query->where(function ($subQuery) use ($childRoleIds) {
                    $subQuery->whereHas('identifier', function ($roleSubQuery) use ($childRoleIds) {
                        $roleSubQuery->whereIn('role_id', $childRoleIds);
                    })->orWhereHas('letterReceivers', function ($receiverSubQuery) use ($childRoleIds) {
                        $receiverSubQuery->whereHas("identifier", function($q) use ($childRoleIds) {
                            $q->whereIn('role_id', $childRoleIds);
                        });
                    });
                });
            })->orderBy('created_at', 'desc')->get();

            return DataTables::of($letters)
                ->addColumn('action', function ($letter) {
                    return '<div class="btn-detail" id="btn-' . $letter->id . '">
                    <a href="' . asset("/storage/letter/$letter->file") . '" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
                </div>';
                })
                ->addColumn('name', function ($action) {
                    return $action->user->name;
                })
                ->addColumn('email', function ($action) {
                    return $action->user->email;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    private function getChildRoleIds($roleIds)
    {
        $childRoleIds = Role::whereIn('parent_id', $roleIds)->pluck('id')->toArray();
        if (!empty($childRoleIds)) {
            $childRoleIds = array_merge($childRoleIds, $this->getChildRoleIds($childRoleIds));
        }
        return $childRoleIds;
    }
}
