<?php

namespace App\Http\Controllers;

use App\Models\TenantMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantMenuController extends Controller
{
    // Middleware untuk authentication tenant dihapus dikarenakan function disini tidak hanya bisa diakses oleh tenant

    // TenantMenu creation by Tenant
    public function create(Request $request)
    {
        // Validation rules
        $request['tenant_id'] = Auth::guard('tenant')->user()->id;
        $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'tenant_menu_category_id' => 'required|exists:tenant_menu_categorys,id',
            'tenant_menu_name' => 'required|string|max:255',
            'tenant_menu_description' => 'required|string|max:255',
            'tenant_menu_price' => 'required|numeric|min:0',
            'tenant_menu_status' => 'required|integer|min:0',
        ]);

        // Create a new tenant menu
        TenantMenu::create($request->all());

        return redirect()->route('dashboard')
            ->with('success', 'Tenant Menu created successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenantMenus = TenantMenu::all();
        return view('tenant_menus.index', ['tenantmenus' => $tenantMenus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['tenant_id'] = Auth::guard('tenant')->user()->id;
        $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'tenant_menu_category_id' => 'required|exists:tenant_menu_categorys,id',
            'tenant_menu_name' => 'required|string|max:255',
            'tenant_menu_description' => 'required|string|max:255',
            'tenant_menu_price' => 'required|numeric|min:0',
            'tenant_menu_status' => 'required|integer|min:0',
        ]);

        TenantMenu::create($request->all());

        // return 'insert menu success';
        return redirect()->route('dashboard')
            ->with('success', 'Tenant Menu created successfully.');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tenant_menu_category_id' => 'required|exists:tenant_menu_categorys,id',
            'tenant_menu_name' => 'required|string|max:255',
            'tenant_menu_description' => 'required|string|max:255',
            'tenant_menu_price' => 'required|numeric|min:0',
            'tenant_menu_status' => 'required|integer|min:0',
        ]);

        $menu = TenantMenu::findOrFail($id);
        $menu->update($request->all());

        return redirect()->route('dashboard')
            ->with('success', 'Tenant Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = TenantMenu::findOrFail($id);
        $menu->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Tenant Menu deleted successfully.');
    }

    // Search function
    public function search(Request $request)
    {
        $query = $request->input('query');

        $tenantMenus = TenantMenu::where('tenant_menu_name', 'LIKE', "%$query%")
            ->orWhere('tenant_menu_description', 'LIKE', "%$query%")
            ->get();

        return view('tenant_menus.index', compact('tenantMenus'));
    }

    // Filter by category
    public function filter(Request $request)
    {
        $category = $request->input('category');

        $tenantMenus = TenantMenu::where('tenant_menu_category', $category)->get();

        return view('tenant_menus.index', compact('tenantMenus'));
    }
}
