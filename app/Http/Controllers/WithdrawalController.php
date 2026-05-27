<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function choose()
    {
        return view('withdraw.choose');
    }

    public function gcash()
    {
        return view('withdraw.gcash');
    }

    public function bank()
    {
        return view('withdraw.bank');
    }

    public function process(Request $request)
{
    $request->validate([
        'method' => 'required',
        'account_name' => 'required',
        'account_number' => 'required',
    ]);

    $user = auth()->user();

    // ONLY get commissions not yet withdrawn
    $withdrawAmount = $user->orders()
        ->whereNotNull('commission')
        ->whereNull('withdrawn_at')
        ->sum('commission');

    // Mark only unwithdrawn commissions as withdrawn
    $user->orders()
        ->whereNotNull('commission')
        ->whereNull('withdrawn_at')
        ->update([
            'withdrawn_at' => now(),
        ]);

    return redirect()
        ->route('profile.edit')
        ->with([
            'status' => 'withdrawn',
            'withdrawn_amount' => number_format($withdrawAmount, 2),
        ]);
}
}