<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;

/*EJEMPLO

//$users = DB::connection('freelanceTAW')->select('name')->where('id', '=', '1');
//$user = User::select('name')->where('id', '=', '1');

return [
    'supportEmail' => 'JonathanDuque@gmail.com',
    'adminEmail' => 'admin@sitename.com',
    'name' => $users
];*/