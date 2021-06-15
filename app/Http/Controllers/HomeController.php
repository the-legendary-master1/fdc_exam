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

    function action(Request $request)
    {
        if($request->ajax()) {
            $output = '';
            $query = $request->get('query');

            if($query != '') {
                $data = Contact::where('name', 'like', '%'.$query.'%')
                    ->orWhere('company', 'like', '%'.$query.'%')
                    ->orWhere('phone', 'like', '%'.$query.'%')
                    ->orWhere('email', 'like', '%'.$query.'%')
                    ->paginate(5);
             
            } else {
               $data = Contact::orderby('id', 'desc')->paginate(5);
            }

            $total_row = $data->count();
            if($total_row > 0) {
                foreach($data as $row) {
                    $output .= '
                    <tr>
                        <td>'.$row->name.'</td>
                        <td>'.$row->company.'</td>
                        <td>'.$row->phone.'</td>
                        <td>'.$row->email.'</td>
                        <td class="text-center">
                            <div class="btn-group" >
                                <button type="button" class="btn btn-primary edit_contact" data-contact="'.$row.'">Edit</button>
                                <button type="button" class="btn btn-danger delete_contact" data-contact="'.$row->id.'">Delete</button>
                            </div>
                        </td>
                    </tr>
                    ';
                }
            } else {
                $output = '
                <tr>
                 <td align="center" colspan="4">No Data Found</td>
                </tr>
                ';
            }

            $data = array(
             'table_data'  => $output,
            );

            echo json_encode($data);
        }
    }
}
