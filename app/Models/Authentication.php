<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    use HasFactory;

    public static function checkIfExistsByAttr($column, $variable) {
        return \DB::table('users')->where($column, '=', $variable)->first();
    }
    public static function registerUser($username, $email, $password) {
        return \DB::table('users')->insert([
            'username' => $username,
            'email' => $email,
            'password' => md5($password),
            'user_privilege_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
    public static function loginAttempt($email, $password) {
        return \DB::table('users')->where("email", '=', $email)->where("password", "=", md5($password))->first();
    }
}
