@extends('layout')

@section('title','Tenant Register | E - Foodcourt')

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

</style>

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

                  <form method="POST" action="{{route('admin.handleTenantRegister')}}">
                    @csrf
                    <a href="" class="d-flex align-items-center mb-3 pb-1">
                        <span class="h1 fw-bold mb-0 logo">E - Foodcourt</span>
                    </a>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Hola new tenant!</h5>

                    <div class="form-outline mb-4">
                        <input type="text" id="form2Example17" class="form-control form-control-lg" name='tenant_name' placeholder="input tenant name"/>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" id="form2Example17" class="form-control form-control-lg" name='tenant_location' placeholder="input tenant location"/>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" id="form2Example17" class="form-control form-control-lg" name="email" placeholder="input tenant email"/>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="form2Example27" class="form-control form-control-lg" name='password' placeholder="input tenant password"/>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="form2Example27" class="form-control form-control-lg" name='confirm_password' placeholder="confirm tenant password"/>
                    </div>

                    <div class="card bg-image" style="margin-bottom: 25px !important; height: 250px; position: relative;">
                        <input type="file" name="tenant_picture" id="imageInput" style="display: none;" accept="image/*" />
                        <label for="imageInput" class="card-img-label" style="cursor: pointer; display: block; height: 100%; width: 100%;">
                            <img src="{{asset('storage/assets/sushi.jpg')}}" id="imagePreview" class="card-img" alt="..." style="height: 100%; width: 100%; object-fit: cover;">
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

                    <div class="pt-1 mb-4">
                        <button class="btn btn-dark btn-lg btn-block" type="submit" >add</button>
                    </div>

                    <p class="mb-5 pb-lg-2" style="color: #393f81;">back to dashboard? <a href={{route('admin.dashboardPage')}}
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


<script>
document.getElementById('imageInput').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('imagePreview').src = URL.createObjectURL(file);
    }
});

</script>

@endsection
