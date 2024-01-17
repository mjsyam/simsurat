<?php
namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Models\Letter;
use App\Models\Role;
use Carbon\Carbon;

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
                ->addColumn('user', function ($letter) {
                    return $letter->user->name;
                })
                ->addColumn('signed', function ($letter) {
                    return $letter->signed->name;
                })
                ->addColumn('receiver', function ($letter) {
                    $names = $letter->letterReceivers->map(function ($item) {
                        return $item->user->name;
                    })->take(2)->toArray();

                    $count = $letter->letterReceivers->count();

                    if ($count > 2) {
                        return implode(', ', $names) . " dan " . ($count - 2) . " lainnya";
                    }

                    return implode(', ', $names);
                })
                ->addColumn('category', function ($letter) {
                    return $letter->letterCategory->name;
                })
                ->addColumn('created_at', function ($letter) {
                    return Carbon::parse($letter->created_at)->format('Y-m-d H:i:s');
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
