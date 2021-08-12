<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

/**
 *
 */
class UserRepository
{
    // Get methods
    public function get_user_data($data) {
        $page = $data['page'] ?? 1;
        $limit = $data['count'] ?? 10;
        $offset = ($page - 1) * $limit;

        $data = User::orderBy('id', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return $data;
    }

    // Create methods
    public function check_create_request($data) {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'phone' => 'required|',
        ];

        return Validator::make($data, $rules);
    }

    public function create_user($data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);
    }

    // Edit Methods
    public function check_edit_request($data) {
        $rules = [
            'user_id' => 'required',
            'email' => 'unique:users|email',
        ];

        return Validator::make($data, $rules);
    }

    public function edit_user($data) {
        $user = User::find( $data['user_id'] );
        $user->name = $data['name'] ?? $user->name;
        $user->email = $data['email'] ?? $user->email;
        $user->phone = $data['phone'] ?? $user->phone;
        $user->save();
        return $user;
    }

    public function check_user_id($data) {
        $rules = [
            'user_id' => 'required',
        ];

        return Validator::make($data, $rules);
    }

    public function delete_user($data) {
        $mess = true;

        try {
            $user = User::find( $data['user_id'] );
            $user->delete();
        } catch (\Exception $e) {
            $mess = false;
        }

        return ['message' => $mess];
    }
}
