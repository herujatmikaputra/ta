<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileMemberController extends Controller
{
    public function profile(){
        $member = Member::find(Auth::user()->member->id);
        return view('member.profile.index',compact('member'));
    }
}
