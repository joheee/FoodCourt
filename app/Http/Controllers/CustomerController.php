<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Tenant;
use App\Models\TenantMenu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function landingPage()
    {
        $tenant = Tenant::all();
        return view('customer.landing', compact('tenant'));
    }
    public function tenantDetailPage($id)
    {
        $tenant = Tenant::find($id)->first();
        $menu = $tenant->tenantMenus;
        $user_id = Auth::guard('web')->id();

        return view('customer.tenant_detail', compact('tenant', 'menu'));
    }
    public function handleAddToCart($id, $isUpdate){
        $currTenant = Tenant::whereHas('tenantMenus', function ($query) use ($id) {
            $query->where('id', $id);
        })->first();

        $currMenu_id = $id;
        $user_id = Auth::guard('web')->id();

        // check if the cart is created
        $currCart = Cart::where('user_id', $user_id)->where('status','=','true')->first();
        if($currCart == null) {
            $currCart = Cart::create([
                'user_id' => $user_id,
                'status' => 'true'
            ]);
        }

        $currCartItem = CartItem::where('cart_id', $currCart->id)->where('tenant_menu_id',$currMenu_id)->first();

        if($currCartItem == null) {
            // dd($currMenu_id);
            CartItem::create([
                'cart_id' => $currCart->id,
                'tenant_menu_id' => $currMenu_id,
                'quantity' => 1
            ]);
        } else {
            $identifier = $isUpdate == 1 ? 1 : -1;
            if($currCartItem->quantity == 1 && $isUpdate == 2) $currCartItem->delete();
            else {
                $currCartItem->quantity += $identifier;
                $currCartItem->save();
            }
        }
        return redirect()->back();
    }

    public function customerCartPage(){
        $user_id = Auth::guard('web')->id();
        $menu = Cart::where('user_id', '=', $user_id)->where('status','=','true')->first();
        return view('customer.customer_cart', compact('menu'));
    }
    public function customerCheckoutPage(){
        $user_id = Auth::guard('web')->id();
        $menu = Cart::where('user_id', '=', $user_id)->first();
        $total = 0;
        foreach ($menu->cartItems as $c) {
            $total += $c->quantity * $c->tenantMenus->tenant_menu_price;
            }
        return view('customer.customer_checkout', compact('menu', 'total'));
    }

    public function handleCustomerCheckout(Request $request){
        $request->validate([
            'total_price' => 'required',
            'payment_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000',
        ]);
        $user_id = Auth::guard('web')->id();
        $user_cart = Cart::where('user_id', '=', $user_id)->where('status','=','true')->first();
        $cart_id = $user_cart->id;

        foreach ($user_cart->cartItems as $c) {
            $tenant_id = $c->tenantMenus->tenants->id;
            $data['user_id'] = $user_id;
            $data['cart_id'] = $cart_id;
            $data['tenant_id'] = $tenant_id;
            $data['order_status'] = 0;

            $image = $request->file('payment_picture');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/assets/payment', $imageName);
            $data['payment_picture']  = $imageName;

            Order::create($data);
            $user_cart->status = 'false';
            $user_cart->save();
        }

        return redirect()->route('customer.landingPage');
    }
    public function customerProfilePage(){
        $user = Auth::guard('web')->user();
        return view('customer.customer_profile', compact('user'));
    }
    public function handleUpdateProfile(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        $data = $request->except('picture');

        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/assets/user', $imageName);
            $data['picture'] = $imageName;
        }

        $id = Auth::guard('web')->user()->id;
        $user = User::findOrFail($id);
        $user->update($data);

        return redirect()->back();
    }

    public function customerHistoryPage(){
        $id = Auth::guard('web')->user()->id;
        $order = Order::where('user_id','=',$id)->get();
        return view('customer.customer_history', compact('order'));
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
