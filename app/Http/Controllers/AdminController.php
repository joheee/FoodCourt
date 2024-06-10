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
        $data['password'] = Hash::make($request['password']);
        $data['super_user_id'] = Auth::guard('superuser')->id();

        Tenant::create($data);
        return redirect()->route('admin.dashboardPage');
    }

    public function editTenantPage($id){
        $tenant = Tenant::find($id)->first();
        return view('admin.tenant_edit', compact('tenant'));
    }
    public function handleEditTenantPage($id, Request $request){
        $request->validate([
            'tenant_name' => 'required|string|max:255',
            'tenant_location' => 'required|string|max:20',
        ]);

        // Extract all request data except the 'tenant_picture'
        $data = $request->except('tenant_picture');

        // If a new tenant picture is uploaded, process it
        if ($request->hasFile('tenant_picture')) {
            $image = $request->file('tenant_picture');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/assets/tenant', $imageName);
            $data['tenant_picture'] = $imageName;
        }

        // Find the tenant by ID
        $tenant = Tenant::findOrFail($id);
        $tenant->update($data);

        return redirect()->route('admin.dashboardPage');
    }

    public function handleDeleteTenant($id)
    {
        Tenant::destroy($id);
        return redirect()->route('admin.dashboardPage');
    }
}
