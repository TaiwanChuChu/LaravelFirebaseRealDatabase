<?php

namespace App\Http\Controllers\Firebase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * @var \Kreait\Firebase\Database
     */
    private $database;
    /**
     * @var string
     */
    private $tableName;

    public function __construct(\Kreait\Firebase\Database $database)
    {
        $this->database = $database;
        $this->tableName = 'contacts';
    }

    public function index()
    {
        $contacts = $this->database->getReference($this->tableName)->getValue();

        return view('firebase.contact.index', compact('contacts'));
    }

    public function create()
    {
        return view('firebase.contact.create');
    }

    public function store(Request $request)
    {
        $payload = [
          'fname' => $request->first_name,
          'lname' => $request->last_name,
          'phone' => $request->phone,
          'email' => $request->email,
        ];

        $postRef = $this->database->getReference($this->tableName)->push($payload);

        if ($postRef) {
            return redirect('contacts')->with('status', 'Contact Added Successfully');
        }

        return redirect('contacts')->with('status', 'Contact Not Added');

    }

    public function edit($id)
    {
        $contact = $this->database->getReference($this->tableName)->getChild($id)->getValue();

        if (!$contact) {
            return redirect('contacts')->with('status', 'Contact ID Not Found');
        }

        return view('firebase.contact.edit', compact('contact', 'id'));
    }

    public function update(Request $request, $id)
    {
        $contact = $this->database->getReference($this->tableName . '/' . $id)->getSnapshot();
        if (!$contact->exists()) {
            return redirect('contacts')->with('status', 'Contact ID Not Found');
        }

        $payload = [
            'fname' => $request->first_name,
            'lname' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        $contact->getReference()->update($payload);

        return redirect('contacts')->with('status', 'Contact Updated Successfully');

    }

    public function destroy($id)
    {
        $contact = $this->database->getReference($this->tableName . '/' . $id)->getSnapshot();
        if (!$contact->exists()) {
            return redirect('contacts')->with('status', 'Contact ID Not Found');
        }

        $contact->getReference()->remove();

        return redirect('contacts')->with('status', 'Contact Deleted Successfully');
    }
}
