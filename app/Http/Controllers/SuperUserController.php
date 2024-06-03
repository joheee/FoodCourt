<?php

namespace App\Http\Controllers;

use App\Models\SuperUser;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SuperUserController extends Controller
{
    public function index()
    {
        $superUsers = SuperUser::all();
        return view('super_users.index', compact('superUsers'));
    }

    public function create()
    {
        return view('super_users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:super_users',
            'password' => 'required|string|min:6',
        ]);

        $request['password'] = bcrypt($request['password']);

        SuperUser::create($request->all());

        // return 'superuser success';

        return redirect()->route('super_users.index')
            ->with('success', 'Super User created successfully.');
    }

    public function show(SuperUser $superUser)
    {
        return view('super_users.show', compact('superUser'));
    }

    public function edit(SuperUser $superUser)
    {
        return view('super_users.edit', compact('superUser'));
    }

    public function update(Request $request, SuperUser $superUser)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:super_users,email,' . $superUser->id,
            'password' => 'nullable|string|min:6',
        ]);

        $superUser->update($request->all());

        return redirect()->route('super_users.index')
            ->with('success', 'Super User updated successfully');
    }

    public function destroy(SuperUser $superUser)
    {
        $superUser->delete();

        return redirect()->route('super_users.index')
            ->with('success', 'Super User deleted successfully');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('superuser')->attempt($credentials)) {
            Session::put('mysession', $credentials);
            session()->regenerate();

            // return 'superuser login success';
            return redirect()->intended('dashboard');
        }

        // return 'login gagal';
        return back()->withErrors([
            'super_user_email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    // SuperUserController
    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|string|max:255',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update(['payment_status' => $request->payment_status]);

        return redirect()->route('payments.index')
            ->with('success', 'Payment status updated successfully.');
    }

}
