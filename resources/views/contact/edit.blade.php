@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-7">
                <h1>Contact</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('contact.index')}}">Contact</a></li>
                        <li class="breadcrumb-item " aria-current="page" >Create</li>
                        <li class="breadcrumb-item active" aria-current="page" >Edit</li>

                    </ol>
                </nav>
                <div class="card px-3 py-3">
                    <form action="{{route('contact.update',$contact->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <img src="{{asset("storage/photo/".$contact->photo)}}" id="photoPreview" alt="" class="rounded-circle  @error('photo') border border-danger is-invalid @enderror w-25">
                            <input type="file" name="photo" class="d-none" id="photo" accept="image/jpeg,image/png">
                            @error('photo')
                            <div class="text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$contact->name)}}" name="name" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Name</label>
                            @error('name')
                            <div class="text-danger ps-2">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" value="{{old('name',$contact->phone)}}" name="phone" id="floatingPassword" placeholder="Phone">
                            <label for="floatingPassword">Phone</label>
                            @error('phone')
                            <div class="text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-outline-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("js")
    <script>
        let photoPreview = document.querySelector("#photoPreview");
        let photo = document.querySelector("#photo");
        photoPreview.addEventListener("click",_=>photo.click())
        photo.addEventListener("change",_=>{
            let file = photo.files[0];
            let reader = new FileReader();
            reader.onload = function (){
                photoPreview.src = reader.result;
            }
            reader.readAsDataURL(file);
        })
    </script>
@endpush
