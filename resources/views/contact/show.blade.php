@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-7">
                <h1 class="text-center">Contact</h1>
                <div class="card shadow mb-2 p-2">
                    <div class="row justify-content-between ">
                        <div class="col-7 ">
                            <label class="visually-hidden" for="specificSizeInputGroupUsername">Search</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </div>
                                <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Search">
                            </div>
                        </div>
                        <div class="col-2 me-3">
                            <a  href="{{route('contact.create')}}" class="btn btn-primary">
                                Create</a>
                        </div>
                    </div>

                </div>
                    <div class="card mb-2 border shadow">
                        <div class="row  align-items-center p-2 g-0">
                            <div class="col-2 text-center">
                                <img src="{{ asset("storage/photo/".$contact->photo) }}" class="user-img rounded-circle" alt="">
                            </div>
                            <div class="col-3">
                                <p class="fw-bold p-0 m-0">{{$contact->name}}</p>
                            </div>
                            <div class="col-3">
                                <p class="fw-bold p-0 m-0">{{$contact->phone}}</p>
                            </div>
                            <div class="col-3 text-end p-1 d-flex justify-content-end">

                                <a href="{{route("contact.index")}}" class="btn btn-sm btn-success">See More</a>

                            </div>
                        </div>


                    </div>
            </div>
        </div>
    </div>
@endsection
