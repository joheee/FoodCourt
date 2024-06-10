@extends('layout')

@section('title','Tenant Edit | E - Foodcourt')

@section('content')

<style>
.card-img-label {
    position: relative;
}

.card-img-overlay {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(0, 0, 0, 0.3);
    transition: background 0.3s ease;
}

.card-img-label:hover .card-img-overlay {
    background: rgba(0, 0, 0, 0.5);
}

#imagePreview {
    object-fit: cover;
    width: 100%;
    height: 100%;
}

.container {
padding: 2rem 0rem;
}

h4 {
margin: 2rem 0rem 1rem;
}

.table-image {
td, th {
    vertical-align: middle;
}
}

</style>

<section class="vh-100" style="background-color: #22C7A9;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card overflow-hidden" style="border-radius: 1rem;">
              <div class="d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                <form method="POST" enctype="multipart/form-data" action="{{route('customer.handleCustomerCheckout')}}" class="d-flex flex-column align-items-center">
                    @csrf
                    <a href="" class="d-flex align-items-center mb-3 pb-1">
                        <span class="h1 fw-bold mb-0 logo">E - Foodcourt</span>
                    </a>


                    <div class="w-50 gap-5 d-grid justify-content-center">
                        <div class="text-center fw-bold display-7 bg-white rounded-md" style="border-radius: 10px">Customer's Cart</div>
                        <div class="">
                            <table class="table table-image">
                            <thead>
                                <tr>
                                <th scope="col">Picture</th>
                                <th scope="col">Menu Name</th>
                                <th scope="col">Menu Price</th>
                                <th scope="col">Menu Quantity</th>
                                <th scope="col">Menu Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menu->cartItems as $c)
                                    <tr>
                                    <td class="w-25">
                                        <img src="{{ asset('storage/assets/menu/' . $c->tenantMenus->tenant_menu_picture) }}" class="img-fluid img-thumbnail" alt="Sheep">
                                    </td>
                                    <td>{{$c->tenantMenus->tenant_menu_name}}</td>
                                    <td>IDR {{$c->tenantMenus->tenant_menu_price}}</td>
                                    <td>IDR {{$c->quantity}}</td>
                                    <td>IDR {{$c->tenantMenus->tenant_menu_price * $c->quantity}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-outline">
                        <input readonly value={{$total}} type="text" id="form2Example27" class="" name="total_price" placeholder="menu's name"/>
                    </div>

                    <div class="card bg-image" style="margin-bottom: 25px !important; height: 250px; position: relative;">
                        <input type="file" name="payment_proof" id="imageInput" style="display: none;" accept="image/*" />
                        <label for="imageInput" class="card-img-label" style="cursor: pointer; display: block; height: 100%; width: 100%;">
                            <img src="{{asset('storage/assets/tenant/')}}" id="imagePreview" class="card-img" alt="..." style="height: 100%; width: 100%; object-fit: cover;">
                            <div class="card-img-overlay d-flex justify-content-center align-items-center" style="background: rgba(0, 0, 0, 0.3);">
                                <i class="fa-solid fa-plus text-white" style="font-size: 24px;"></i>
                            </div>
                        </label>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert" >
                            {{$errors->first()}}
                        </div>
                    @endif

                    <div class="mb-4 d-flex justify-content-center align-items-center gap-4">
                        <button class="btn btn-dark btn-lg" type="submit">checkout</button>
                    </div>
                </form>


                    <p class="mb-2 pb-lg-2" style="color: #393f81;">back to cart page? <a href={{route('customer.customerCartPage')}} style="color: #22C7A9;">Click here</a></p>


                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
</section>


<script>
document.getElementById('imageInput').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('imagePreview').src = URL.createObjectURL(file);
    }
});

</script>

@endsection
