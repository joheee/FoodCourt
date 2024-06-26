@extends('layout')

@section('title','Add Category | E - Foodcourt')

@section('content')

<section class="vh-100" style="background-color: #22C7A9;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card overflow-hidden" style="border-radius: 1rem;">
            <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-flex align-items-center justify-content-center" style="background-color: #22C7A9;">
                    <img src={{asset('storage/assets/login.png')}}
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                    <form method="POST" action="{{route('tenant.handleCategoryAdd')}}">
                        @csrf
                        <a href="" class="d-flex align-items-center mb-3 pb-1">
                            <span class="h1 fw-bold mb-0 logo">E - Foodcourt</span>
                        </a>

                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Add new category</h5>

                        <div class="form-outline mb-4">
                            <input type="text" id="form2Example27" class="form-control form-control-lg" placeholder="category name" name="tenant_menu_category_name"/>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert" >
                                {{$errors->first()}}
                            </div>
                        @endif

                        <div class="pt-1 mb-4">
                            <button class="btn btn-dark btn-lg btn-block" type="submit">Add</button>
                        </div>

                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Back to category page? <a href={{route('tenant.categoryPage')}}
                            style="color: #22C7A9;">Click here</a></p>
                    </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection
