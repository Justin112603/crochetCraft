<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // Update name, email, phone
public function update(Request $request)
{
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . auth()->id(),
        'phone' => 'nullable|string|max:20',
    ]);

    auth()->user()->update($validated);

    return back()->with('status', 'profile-updated');
}

// Update address only
public function updateAddress(Request $request)
{
    $request->validate([
        'address' => 'required|string|max:500',
    ]);

    auth()->user()->update(['address' => $request->address]);

    return back()->with('status', 'address-updated');
}


public function withdraw(Request $request)
{
    $user = auth()->user();

    // Get ONLY commissions not withdrawn yet
    $orders = Order::where('user_id', $user->id)
        ->whereNotNull('commission')
        ->whereNull('withdrawn_at')
        ->get();

    // Total available commission
    $totalCommission = $orders->sum('commission');

    // Prevent empty withdrawal
    if ($totalCommission <= 0) {
        return back()->with('error', 'No commission available.');
    }

    DB::transaction(function () use ($orders, $user, $totalCommission) {

        // Save withdrawal record
        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $totalCommission,
        ]);

        // Mark every order as withdrawn
        foreach ($orders as $order) {
    $order->withdrawn_at = now();
    $order->save();
}
    });

   return redirect()
    ->route('profile.edit')
    ->with([
        'status' => 'withdrawn',
        'withdrawn_amount' => number_format($totalCommission, 2),
    ]);
}
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
