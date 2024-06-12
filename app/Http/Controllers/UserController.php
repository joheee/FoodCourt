<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loginPage()
    {
        $users = Auth::guard('web')->user();
        return view('auth.login', compact('users'));
    }
    public function registerPage()
    {
        $users = Auth::guard('web')->user();
        return view('auth.register', compact('users'));
    }
    public function handleRegister(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:users|unique:tenants,email|unique:super_users,email',
            'phone_number' => 'required|string|max:255',
            'password' => 'required|string|min:4',
            'confirm_password' => 'required|string|min:4',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000',
        ]);

        $image = $request->file('picture');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('public/assets/user', $imageName);
        $request['picture'] = $imageName;

        $request['password'] = Hash::make($request['password']);
        Cookie::queue('last_email', $request['email'], 60 * 24 * 30);

        $data = $request->all();
        $data['picture'] = $imageName;
        User::create($data);

        return redirect()->route('guest.loginPage')
            ->with('success', 'User created successfully.');
    }
    public function handleLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Cookie::queue('last_email', $request['email'], 60 * 24 * 30);

        if(Auth::guard('web')->attempt($request->only('email','password'))){
            return redirect()->route('customer.landingPage');
        }
        if(Auth::guard('superuser')->attempt($request->only('email','password'))) {
            return redirect()->route('admin.dashboardPage');
        }
        if(Auth::guard('tenant')->attempt($request->only('email','password'))) {
            return redirect()->route('tenant.allPage');
        }

        return redirect()->back()->withErrors([
             'email' => 'These credentials do not match our records.',
        ])->withInput($request->only('email', 'remember'));
    }
    public function handleLogout(Request $request)
    {
        // Check and logout from each guard
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        if (Auth::guard('superuser')->check()) {
            Auth::guard('superuser')->logout();
        }

        if (Auth::guard('tenant')->check()) {
            Auth::guard('tenant')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guest.loginPage');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $request['password'] = bcrypt($request['password']);

        User::create($request->all());

        // return 'register user success';

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,user_email,' . $id,
            'phone_number' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            Session::put('mysession', $credentials);
            session()->regenerate();
            // return 'login success';

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'user_email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect('/');
    }

}
