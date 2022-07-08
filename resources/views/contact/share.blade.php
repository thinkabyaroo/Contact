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
                                        <input class="form-check-input" form="bulk_share" type="checkbox" name="contact_ids[]" value="{{ $contact->id }}" id="contact{{ $contact->id  }}" checked>
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
                            </li>
                        @empty
                        @endforelse
                    </ul>

                    <div class="mt-3">
                        <form action="{{ route('contact.bulkShare')  }}" method="post" id="bulk_share">
                            @csrf
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" class="form-control" name="email">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary w-100">
                                        <i class="fa-solid fa-paper-plane fa-fw"></i> Share
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
