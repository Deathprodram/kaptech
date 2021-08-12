<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct() {
        $this->user_repository = new UserRepository;
    }

    public function get_users(Request $request) {
        return $this->user_repository
            ->get_user_data( $request->all() );
    }

    public function create_user(Request $request) {
        $validator = $this->user_repository
            ->check_create_request( $request->all() );

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first()
            ], 401);
        }

        return $this->user_repository
            ->create_user( $request->all() );
    }

    public function edit_user(Request $request) {
        $validator = $this->user_repository
            ->check_edit_request( $request->all() );

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first()
            ], 401);
        }

        return $this->user_repository
            ->edit_user( $request->all() );
    }

    public function delete_user(Request $request) {
        $validator = $this->user_repository
            ->check_user_id( $request->all() );

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first()
            ], 401);
        }

        return $this->user_repository
            ->delete_user( $request->all() );
    }
}
