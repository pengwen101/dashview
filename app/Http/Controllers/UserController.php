<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(){
        $pendingUsers = User::where('is_email_approved', 0)->get();
        $approvedUsers = User::where('is_email_approved', 1)->get();

        return view('user', [
            'pendingUsers' => $pendingUsers,
            'approvedUsers' => $approvedUsers,
        ]);
    }

    public function approveUser($id){
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->is_email_approved = 1;
            $user->email_approved_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->save();
            return redirect()->back()->with('success', 'User approved successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    public function unapproveUser($id){
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->is_email_approved = 0;
            $user->email_approved_at = null;
            $user->save();
            return redirect()->back()->with('success', 'User unapproved successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }
}
