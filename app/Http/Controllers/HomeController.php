<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function trash(){
        $contacts=Contact::onlyTrashed()->get();
        return view('trash',compact('contacts'));
    }

    public function trashBulkAction(Request $request){
//        return $request;
        if ($request->functionality == 1){
            $contacts=Contact::onlyTrashed()->whereIn("id",$request->contact_ids)->get();
            foreach ($contacts as $contact){
                $contact->restore();
            }
        }else if ($request->functionality == 2){
            $contacts=Contact::onlyTrashed()->whereIn("id",$request->contact_ids);
            $contacts->forceDelete();
        }

        return redirect()->back();
    }

}
