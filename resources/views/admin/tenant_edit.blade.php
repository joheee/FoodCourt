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

                <form method="POST" enctype="multipart/form-data" action="{{route('admin.handleEditTenantPage', ['id' => $tenant->id])}}">
                    @csrf
                    <a href="" class="d-flex align-items-center mb-3 pb-1">
                        <span class="h1 fw-bold mb-0 logo">E - Foodcourt</span>
                    </a>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Edit {{$tenant->tenant_name}}</h5>

                    <div class="form-outline mb-4">
                        <input value="{{$tenant->tenant_name}}" type="text" id="form2Example17" class="form-control form-control-lg" name='tenant_name' placeholder="input tenant name"/>
                    </div>

                    <div class="form-outline mb-4">
                        <input value="{{$tenant->tenant_location}}" type="text" id="form2Example17" class="form-control form-control-lg" name='tenant_location' placeholder="input tenant location"/>
                    </div>

                    <div class="card bg-image" style="margin-bottom: 25px !important; height: 250px; position: relative;">
                        <input type="file" name="tenant_picture" id="imageInput" style="display: none;" accept="image/*" />
                        <label for="imageInput" class="card-img-label" style="cursor: pointer; display: block; height: 100%; width: 100%;">
                            <img src="{{asset('storage/assets/tenant/'.$tenant->tenant_picture)}}" id="imagePreview" class="card-img" alt="..." style="height: 100%; width: 100%; object-fit: cover;">
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
                        <button class="btn btn-dark btn-lg" type="submit">Edit</button>
                    </div>
                </form>

                    <form class="mb-4 d-flex justify-content-center" action="{{ route('admin.handleDeleteTenant', ['id' => $tenant->id]) }}" method="POST" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg">Delete</button>
                    </form>

                    <p class="mb-2 pb-lg-2" style="color: #393f81;">back to dashboard? <a href={{route('admin.dashboardPage')}} style="color: #22C7A9;">Click here</a></p>

                    <script>
                        function confirmDelete() {
                            return confirm('Are you sure you want to delete this item?');
                        }
                    </script>

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
