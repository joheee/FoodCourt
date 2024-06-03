<?php

namespace App\Http\Controllers;

use App\Models\TenantMenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantMenuCategoryController extends Controller
{
    // TenantMenuCategory creation by Tenant
    public function create(Request $request)
    {
        // Validation rules
        $request->validate([
            'tenant_menu_category_name' => 'required|string|max:255',
        ]);

        // Create a new tenant menu category
        TenantMenuCategory::create($request->all());

        return redirect()->route('dashboard')
            ->with('success', 'Tenant Menu Category created successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $request->validate([
            'tenant_menu_category_name' => 'required|string|max:255',
        ]);

        TenantMenuCategory::create($request->all());

        return redirect()->route('dashboard')
            ->with('success', 'Tenant Menu Category created successfully.');
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
            'tenant_manu_category_name' => 'required|string|max:255',
        ]);

        $tenantMenuCategory = TenantMenuCategory::findOrFail($id);
        $tenantMenuCategory->update($request->all());

        return redirect()->route('dashboard')
            ->with('success', 'Tenant Menu Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tenantMenuCategory = TenantMenuCategory::findOrFail($id);
        $tenantMenuCategory->delete();

    return redirect()->route('dashboard')
        ->with('success', 'Tenant Menu Category deleted successfully.');
    }
}
