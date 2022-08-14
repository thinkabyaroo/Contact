@extends("layouts.app")
@section("content")

<div class="container">
    <div class="row">
        <div class="col-12 col-md-8 align-items-center">
            <h1>Contact</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('contact.index')}}">Contact</a></li>
                    <li class="breadcrumb-item active" aria-current="page" >Index</li>
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
                        <div class="col-6 d-flex align-items-center justify-content-center">
                            <form action="{{route('contact.index')}}" >
                                <input type="text" name="search" placeholder="search" class="border-1 border-info form-control-sm me-1">
                            </form>
                        </div>

                            <div class="col-2 d-flex align-items-center justify-content-end">
                                <a  href="{{route('contact.create')}}" class="btn btn-sm me-2 btn-outline-primary">Create</a>
                                <a  href="{{url('/trash')}}" class="btn btn-sm me-2 btn-outline-danger">Trash</a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="">
                <form action="{{ route('contact.bulkAction') }}" id="bulk_action" method="post">
                    @csrf
                </form>
{{--                <form action="{{route("deleteAll")}}" id="deleteAll" method="post">--}}
{{--                    @method("delete")--}}
{{--                    @csrf--}}
{{--                </form>--}}
                <ul class="list-group">

                    @forelse($contacts as $contact)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="form-check d-flex justify-content-between align-items-center">
                                    <input class="form-check-input" form="bulk_action" type="checkbox" name="contact_ids[]" value="{{ $contact->id }}" id="contact{{ $contact->id}}">
                                    <label class="form-check-label" for="contact{{ $contact->id }}">
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
                                                <p class="fw-bold mb-0">
                                                    {{ $contact->id }}
                                                </p>
                                                <p class="text-black-50 mb-0">
                                                    {{ $contact->phone }}
                                                </p>
                                            </div>
                                        </div>

                                    </label>
                                </div>

                            <div class="btn-group">

                                <button class="shareBtn btn btn-sm btn-outline-primary" id="contact_id{{$contact->id}}" data-bs-toggle="modal" data-bs-target="#email{{$contact->id}}">
                                    <i class="fa-solid fa-fw  fa-paper-plane"></i>
                                </button>
                                <a href="{{ route('contact.edit',$contact->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-fw fa-pencil-alt"></i>
                                </a>
                                <a href="{{ route('contact.delete',$contact->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-fw fa-trash-alt"></i>
                                </a>
                            </div>
                        </li>
                    @empty
                    @endforelse
                </ul>

                <div class="d-flex justify-content-between align-items-start mt-3">
                    <div class="">
                        <div class="d-flex">
                            <select class="form-select me-2" form="bulk_action" name="functionality" required>
                                <option value="">{{__('select action')}}</option>
                                <option value="1">{{__('share contact')}}</option>
                                <option value="2">{{__('delete contact')}}</option>
                            </select>
                            <div class="">
                                <button class="btn btn-outline-primary" form="bulk_action" >{{__('submit')}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        {{ $contacts->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">{{__('share contact')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="">
                    <label class="form-label" for="">{{__('recipient email')}}</label>
                    <input type="text" name="email" form="bulk_action" class="form-control">
                </div>
                <div class="">
                    <label class="form-label" for="">{{__('message')}}</label>
                    <textarea  name="message" form="bulk_action" class="form-control" id="" cols="30" rows="7"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cancelAction()"  class="btn btn-secondary">{{__('close')}}</button>
                <button type="submit" form="bulk_action"  class="btn btn-primary">
                    <i class="fa-solid fa-paper-plane"></i> {{__('share')}}
                </button>
            </div>
        </div>
    </div>
</div>

@foreach($contacts as $contact)
    <div class="modal fade" id="email{{$contact->id}}" tabindex="-1" aria-labelledby="emailLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailLabel">Receiver Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('contact.contactShare',$contact->id)}}" id="contactShare" method="post">
                        @csrf
                        <input type="hidden" name="contact_id" value="{{$contact->id}}">
                        <div class="">
                            <p>{{$contact->id}}</p>
                        </div>
                        <div class="">
                            <label class="form-label" for="">{{__('recipient email')}}</label>
                            <input type="text" name="email[]" class="form-control">
                        </div>
                        <div class="">
                            <label class="form-label" for="">{{__('message')}}</label>
                            <textarea  name="message"class="form-control" id="" cols="30" rows="7"></textarea>
                        </div>
                        <button type="button" onclick="cancelAction()"  class="btn btn-secondary">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-paper-plane"></i> Share
                        </button>
{{--                        <button type="submit" form="contactShare" class="btn btn-primary">--}}
{{--                            <i class="fa-solid fa-paper-plane"></i> Share--}}
{{--                        </button>--}}
                    </form>


                </div>

            </div>
        </div>
    </div>
@endforeach

@endsection

@push("js")
    <script>

        let emailModal = document.querySelector("#emailModal");
        let myEmailModal =new bootstrap.Modal(emailModal,{
            backdrop:"static"
        });
        let contactBulkFunctionalitySelect = document.querySelector(`[name="functionality"]`);
        let shareBtn = document.querySelector('.shareBtn');
        console.log(shareBtn)

        contactBulkFunctionalitySelect.addEventListener("change",function (){
            let selected = Number(this.value);
            console.log(selected);

            if(selected === 1){
                myEmailModal.show();
            }
        })
        function cancelAction(){
            contactBulkFunctionalitySelect.value = "";
            myEmailModal.hide();
        }
    </script>

    <script>
        $(function(e){
            $("#checkAll").click(function (){
                $(".form-check-input").prop('checked',$(this).prop('checked'));
            });
        });
    </script>
@endpush
