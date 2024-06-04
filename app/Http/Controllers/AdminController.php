<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\TenantMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboardPage()
    {
        $tenant = Tenant::all();
        return view('admin.dasboard', compact('tenant'));
    }
    public function tenantRegisterPage(){
        return view('admin.tenant_register');
    }
    public function handleTenantRegister(Request $request){
        $request->validate([
            'tenant_name' => 'required|string|max:255',
            'tenant_location' => 'required|string|max:20',
            'email' => 'required|email|unique:users|unique:tenants,email|unique:super_users,email',
            'password' => 'required|string|min:4',
            'confirm_password' => 'required|string|min:4',
            'tenant_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000',
        ]);
        $image = $request->file('tenant_picture');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('public/assets/tenant', $imageName);

        // Prepare data for creating a new tenant menu
        $data = $request->except('tenant_picture');
        $data['tenant_picture'] = $imageName;
        $request['password'] = Hash::make($request['password']);
        $data['super_user_id'] = Auth::guard('superuser')->id();

        Tenant::create($data);
        return redirect()->route('admin.dashboardPage');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
