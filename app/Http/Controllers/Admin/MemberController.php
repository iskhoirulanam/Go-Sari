<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use App\Models\Hamlet;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index()
    {
        $hamlet = Hamlet::with('user')->get();
        $members = User::all();
        $currentMonth = Carbon::now()->format('F Y');
        return view('admin.members.index', compact('members','hamlet', 'currentMonth'));
    }

    public function changeStatus(Request $request)
    {
        // dd($request->all());
        $userId = $request->member_id;

        $member = User::find($userId);
        $member->status = $request->status;
        $member->save();

        return response()->json([
            'success' => true, 
            'message' => 'Status member berhasil dirubah.',
        ], 200);
    }
}
