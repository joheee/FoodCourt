<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    // Middleware untuk authentication super users dihapus dikarenakan function di tenantController tidak hanya bisa diakses oleh superuser

    // Tenant creation by SuperUser
    public function create(Request $request)
    {
        // Validation rules
        $request['super_user_id'] = Auth::guard('superuser')->user()->id;
        $request->validate([
            'tenant_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants',
            'tenant_location' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'super_user_id' => 'required|exists:super_users,id',
        ]);

        $request['password'] = bcrypt($request['password']);

        // Create a new tenant
        Tenant::create($request->all());

        return redirect()->route('dashboard')
            ->with('success', 'Tenant created successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = Tenant::all();
        return view('tenants.index', ['tenant' => $tenants]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['super_user_id'] = Auth::guard('superuser')->user()->id;
        $request->validate([
            'tenant_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants',
            'tenant_location' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'super_user_id' => 'required|exists:super_users,id',
        ]);

        $request['password'] = bcrypt($request['password']);

        Tenant::create($request->all());

        // return 'register tenant success';
        return redirect()->route('dashboard')
            ->with('success', 'Tenant created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('tenants.show', ['tenant' => $tenant]);
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
            'tenant_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,tenant_email,' . $id,
            'tenant_location' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $tenant = Tenant::findOrFail($id);
        $tenant->update($request->all());

        return redirect()->route('tenants.index')
            ->with('success', 'Tenant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();

        return redirect()->route('tenants.index')
            ->with('success', 'Tenant deleted successfully.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('tenant')->attempt($credentials)) {
            session()->regenerate();

            // return 'tenant login success';
            return redirect()->intended('dashboard');
        }

        // return 'login gagal';
        return back()->withErrors([
            'super_user_email' => 'The provided credentials do not match our records.',
        ]);
    }
}
