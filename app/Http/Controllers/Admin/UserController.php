<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard');
    }
}
