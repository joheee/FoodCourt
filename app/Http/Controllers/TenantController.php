<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\TenantMenu;
use App\Models\TenantMenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    public function allPage(){
        $category = TenantMenuCategory::take(6)->get();
        $menu = TenantMenu::where('tenant_id', Auth::guard('tenant')->id())->take(6)->get();
        return view('tenant.all', compact('category', 'menu'));
    }
    public function menuPage(){
        $menu = TenantMenu::where('tenant_id', Auth::guard('tenant')->id())->get();
        return view('tenant.menu', compact('menu'));
    }
    public function orderPage(){
        return view('tenant.order');
    }
    public function transactionPage(){
        return view('tenant.transaction');
    }
    public function categoryPage(){
        $category = TenantMenuCategory::all();
        return view('tenant.category', compact('category'));
    }
    public function menuAddPage(){
        $category = TenantMenuCategory::all();
        return view('tenant.menu_add', compact('category'));
    }
    public function categoryAddPage(){
        return view('tenant.category_add');
    }
    public function handleMenuAdd(Request $request){
        $request->validate([
            'tenant_menu_name' => 'required|min:3|unique:tenant_menus,tenant_menu_name',
            'tenant_menu_price' => 'required',
            'tenant_menu_description' => 'required|min:3',
            'tenant_menu_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000',
        ]);
        $image = $request->file('tenant_menu_picture');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('public/assets/menu', $imageName);

        // Prepare data for creating a new tenant menu
        $data = $request->except('tenant_menu_picture');
        $data['tenant_menu_picture'] = $imageName;
        $data['tenant_id'] = Auth::guard('tenant')->id();

        // Create a new tenant menu
        TenantMenu::create($data);
        return redirect()->route('tenant.menuPage');
    }
    public function handleCategoryAdd(Request $request){
        $request->validate([
            'tenant_menu_category_name' => 'required|min:3|unique:tenant_menu_categorys,tenant_menu_category_name'
        ]);

        TenantMenuCategory::create($request->all());
        return redirect()->route('tenant.categoryPage');
    }
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

    public function editMenuPage($id) {
        $tenantMenu = TenantMenu::find($id)->first();
        $category = TenantMenuCategory::all();
        return view('tenant.menu_edit', compact('tenantMenu', 'category'));
    }
    public function handleEditMenuPage($id, Request $request) {
        $request->validate([
            'tenant_menu_name' => 'required|min:3|unique:tenant_menus,tenant_menu_name',
            'tenant_menu_price' => 'required',
            'tenant_menu_description' => 'required|min:3',
        ]);
        $data = $request->except('tenant_menu_picture');

        if($request->tenant_menu_picture != null) {
            $image = $request->file('tenant_menu_picture');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/assets/menu', $imageName);
            $data['tenant_menu_picture'] = $imageName;
        }

        // Create a new tenant menu
        TenantMenu::findOrFail($id)->update($data);
        return redirect()->route('tenant.menuPage');
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
