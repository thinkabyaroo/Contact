@extends("layouts.app")
@section("content")

<div class="container">
    <div class="row">
        <div class="col">
            <div class="">
                <form action="{{ route('contact.bulkAction') }}" id="bulk_action" method="post">
                    @csrf
                </form>
                <ul class="list-group">
                    @forelse($contacts as $contact)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" form="bulk_action" type="checkbox" name="contact_ids[]" value="{{ $contact->id }}" id="contact{{ $contact->id  }}">
                                    <label class="form-check-label" for="contact{{ $contact->id  }}">
                                        <div class="">
                                            <p class="fw-bold mb-0">
                                                {{ $contact->name }}
                                            </p>
                                            <p class="text-black-50 mb-0">
                                                {{ $contact->phone }}
                                            </p>
                                        </div>
                                    </label>
                                </div>

                            </div>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-fw  fa-paper-plane"></i>
                                </button>
                                <a href="{{ route('contact.edit',$contact->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-fw fa-pencil-alt"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-fw fa-trash-alt"></i>
                                </button>
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
                <button type="submit" form="bulk_action" class="btn btn-primary">
                    <i class="fa-solid fa-paper-plane"></i> {{__('share')}}
                </button>
            </div>
        </div>
    </div>
</div>

    @push("js")
        <script>

            let emailModal = document.querySelector("#emailModal");
            let myEmailModal =new bootstrap.Modal(emailModal,{
                backdrop:"static"
            });

            let contactBulkFunctionalitySelect = document.querySelector(`[name="functionality"]`);
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
    @endpush

@endsection


