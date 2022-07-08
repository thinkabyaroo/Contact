<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ShareContact;
use App\Http\Requests\StoreShareContactRequest;
use App\Http\Requests\UpdateShareContactRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ShareContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShareContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShareContactRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShareContact  $shareContact
     * @return \Illuminate\Http\Response
     */
    public function show(ShareContact $shareContact)
    {
        if ($shareContact->status){
            return abort(404);
        }
        $from=User::find($shareContact->from);
        $to=User::find($shareContact->to);
        $contacts=Contact::whereIn("id",json_decode($shareContact->contact_ids))->get();
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        return view('shareContact.show',compact('from','to','shareContact','contacts'));
        return $shareContact;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShareContact  $shareContact
     * @return \Illuminate\Http\Response
     */
    public function edit(ShareContact $shareContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShareContactRequest  $request
     * @param  \App\Models\ShareContact  $shareContact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShareContactRequest $request, ShareContact $shareContact)
    {
        if ($request->action === 'accept'){
            Contact::whereIn("id",json_decode($shareContact->contact_ids))->update(["user_id"=>Auth::id()]);
        }
        $shareContact->status=$request->action;
        $shareContact->update();
        return redirect()->route('contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShareContact  $shareContact
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShareContact $shareContact)
    {
        //
    }
}
