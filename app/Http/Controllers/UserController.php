<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Exceptions\NotFoundError;
use App\Models\UserRole;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function getUserRole(Request $request)
    {
        try {
            $request->validate([
                "id" => 'required',
            ]);

            $userRoles = UserRole::where("user_id", $request->id)->get();

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
                $data[] = ['id' => $userRole->id, 'text' => $userRole->role->role];
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
