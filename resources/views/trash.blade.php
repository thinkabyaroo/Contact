@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col">
                <h1>Contact</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('contact.index')}}">Contact</a></li>
                        <li class="breadcrumb-item active" aria-current="page" >Trash</li>
                    </ol>
                </nav>
                <div class="">
                    <div class="card shadow mb-2 p-2">
                        <div class="row justify-content-between ">
                            <div class="col-2 ms-2 ">
                                <div class="form-check">
                                    <input class="form-check-input" form="bulk_action" type="checkbox" id="checkAll">
                                    <label class="form-check-label"  for="">Select All</label>
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center ">
                                <form action="{{route('contact.index')}}" >
                                    <input type="text" name="search" placeholder="search" class="border-1 border-info form-control-sm me-1">
                                </form>
                            </div>

                            <div class="col-2 d-flex align-items-center justify-content-end">
                                <a  href="{{route('contact.create')}}" class="btn btn-sm me-2 btn-outline-primary">Create</a>
                                <form action="{{route("deleteAll")}}" id="checkForm" method="post">
                                    @method("delete")
                                    @csrf
                                    <button type="submit" class="btn btn-sm me-2 btn-outline-dark">Delete All</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">

                </div>
                @foreach($contacts as $contact)
                    <div class="card mb-2 border shadow">
                        <div class="row  align-items-center p-2 g-0">

                            <div class="col-2 text-center">
                                <input class="form-check-input" name="contact_ids[]" type="checkbox" form="checkForm" value="{{$contact->id}}">
                            </div>
                            <div class="col-4">
                                <p class="fw-bold p-0 m-0">{{$contact->name}}</p>
                            </div>
                            <div class="col-6 text-end p-1 d-flex justify-content-end">
                                <form action="{{route('contact.forceDelete',$contact->id)}}" method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger me-2">
                                        Delete
                                    </button>
                                </form>
                                <a href="{{route('contact.restore',$contact->id)}}" class="btn btn-sm me-2 btn-success">Restore</a>
                            </div>
                        </div>


                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-between align-items-center my-2">
                <div class="">
                    <div class="d-flex">
                        <select class="form-select me-2" form="checkForm" name="functionality" required>
                            <option value="">Select Action</option>
                            <option value="1">ReStore</option>
                            <option value="2">Force Delete</option>
                        </select>
                        <div class="">
                            <button class="btn btn-outline-primary" form="checkForm" >Submit</button>
                        </div>
                    </div>
                </div>
{{--                <div class="mt-3">--}}
{{--                    {{ $contacts->appends(Request::all())->links() }}--}}
{{--                </div>--}}
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function(e){
            $("#checkAll").click(function (){
                $(".form-check-input").prop('checked',$(this).prop('checked'));
            });
        });
    </script>
@endpush
