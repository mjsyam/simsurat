<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Exceptions\NotFoundError;
use App\Models\User;
use App\Models\UserRole;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function getUserRoleByUnit(Request $request)
    {
        try {
            $request->validate([
                "id" => 'required',
            ]);

            $userRoles = User::whereId($request->id)->whereHas('user.roles.unit', function($query) {
                $query->whereIn('id', Auth::user()->roles->pluck('unit_id')->toArray());
            })->roles;

            if ($userRoles->isEmpty()) {
                return response()->json([
                    "message" => "success",
                    "data" => [
                        ['id' => '', 'text' => 'No Roles Found']
                    ]
                ]);
            }

            $data = [];
            foreach ($userRoles as $userRole) {
                $data[] = ['id' => $userRole->id, 'text' => $userRole->name];
            }

            return response()->json([
                "message" => "success",
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
