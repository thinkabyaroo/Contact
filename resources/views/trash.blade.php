@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-12 col-md-8">
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
                                <form action="{{route("trashBulkAction")}}" id="trash_bulk_action" method="post">
                                    @method("delete")
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group">

                    @forelse($contacts as $contact)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="form-check d-flex justify-content-between align-items-center">

                                <input class="form-check-input" form="trash_bulk_action" type="checkbox" name="contact_ids[]" value="{{ $contact->id }}" id="contact{{ $contact->id}}">
                                <label class="form-check-label" for="contact{{ $contact->id  }}">

                                    <div class=" d-flex justify-content-between ms-3 align-items-center">
                                        <div id="pf-small-img" class="border border-1 rounded-circle me-2" >
                                            @if($contact->photo)
                                                <img src="{{ asset('storage/photo/'.$contact->photo) }}"  alt='{{$contact->photo}}' class="" alt="">
                                            @elseif($contact->photo==null)
                                                <img src="{{asset('photo/default.png')}}" class="" alt="">
                                            @endif
                                        </div>
                                        <div class="text-start">
                                            <p class="fw-bold mb-0">
                                                {{ $contact->name }}
                                            </p>
                                            <p class="text-black-50 mb-0">
                                                {{ $contact->phone }}
                                            </p>
                                        </div>
                                    </div>

                                </label>
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
                        </li>
                    @empty
                    @endforelse
                </ul>

            </div>
            <div class="d-flex justify-content-between align-items-center my-2">

                <div class="">
                    <div class="d-flex">
                        <select class="form-select me-2" form="trash_bulk_action" name="functionality" required>
                            <option value="">Select Action</option>
                            <option value="1">ReStore</option>
                            <option value="2">Force Delete</option>
                        </select>
                        <div class="">
                            <button class="btn btn-outline-primary" form="trash_bulk_action" >Submit</button>
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
