@extends("layouts.app")
@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="text-center">
                    @if(\Illuminate\Support\Facades\Auth::id()==$from->id)
                        <h4>You shared {{$contacts->count() }} contacts to {{$to->email}}</h4>
                    @else
                        <h4>You got {{$contacts->count() }} contacts from {{$from->email}}</h4>
                    @endif
                    <p>{{$shareContact->message}}</p>
                    <ul class="list-group">
                        @forelse($contacts as $contact)
                            <li class="list-group-item d-flex justify-content-start align-items-center">
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
                            </li>
                        @empty
                        @endforelse
                    </ul>
                    @if(auth()->id()===$shareContact->from)
                        <div class="my-3">
                            <form action="{{route("share-contact.update",$shareContact->id)}}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="action" value="cancel">
                                <button class="btn btn-danger">
                                    Cancel
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="my-3">
                            <form class="d-inline" action="{{route("share-contact.update",$shareContact->id)}}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="action" value="reject">
                                <button class="btn btn-primary">
                                    {{__('reject')}}
                                </button>
                            </form>
                            <form class="d-inline" action="{{route("share-contact.update",$shareContact->id)}}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="action" value="accept">
                                <button class="btn btn-primary">
                                    {{__('accept')}}
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection


