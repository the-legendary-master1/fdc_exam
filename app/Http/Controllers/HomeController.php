<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts = Contact::orderby('id', 'desc')->paginate(5);

        return view('pages.home', compact('contacts'));
    }

    public function welcomePage()
    {

        return view('pages.welcome_page');
    }

    public function addContact(Request $req)
    {
        $contact =  new Contact;
        $contact->name = $req->name;
        $contact->company = $req->company;
        $contact->phone = $req->phone;
        $contact->email = $req->email;
        $contact->save();

        return response()->json(['message' => 'Success']);
    }

    public function editContact(Request $req)
    {
        $contact = Contact::find($req->id);
        $contact->name = $req->name;
        $contact->company = $req->company;
        $contact->phone = $req->phone;
        $contact->email = $req->email;
        $contact->save();

        return response()->json(['message' => 'Success']);
    }

    public function deleteContact($id)
    {
        Contact::find($id)->delete();

        return response()->json(['message' => 'Success']);
    }

    function search(Request $request)
    {
        if($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            
            if($query != '') {
                $contacts = Contact::where('name', 'like', '%'.$query.'%')
                    ->orWhere('company', 'like', '%'.$query.'%')
                    ->orWhere('phone', 'like', '%'.$query.'%')
                    ->orWhere('email', 'like', '%'.$query.'%')
                    ->orderby('id', 'desc')->paginate(5);
             
            } else {
               $contacts = Contact::orderby('id', 'desc')->paginate(5);
            }


            return view('pages.search_data', compact('contacts'))->render();
        }
    }
}
