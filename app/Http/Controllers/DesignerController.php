<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\User;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DesignerController extends Controller
{
    //

    public function all_designers()
    {
        $users=User::where('role_id', '<>', 3 )->get();
        return view('designers.all-designers', ['users' => $users]);
    }

    public function designer_problems(User $user)
    {
        $problems= Problem::where('user_id', $user->id )->get();
        return view('designers.designer-problems', ['problems' => $problems, 'user'=> $user ]);
    }

}
