<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;
use App\User;
class SkillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function storeSkill(Request $request)
    {
        $id   = Auth()->user()->id;
        $user = User::find($id);
        $user->skills()->sync($request->skills, false);
        return redirect()->back();
    }

    public function editSkill()
    {
        $id   = Auth()->user()->id;
        $user = User::find($id);
        $user->skills()->sync($request->skills);
        return redirect()->back();


    }
}
