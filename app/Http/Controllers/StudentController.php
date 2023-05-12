<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Events\NewUserRegistered;

class StudentController extends Controller
{

    public function index()
    {
        $data = Student::latest()->paginate(10); // paginated list of students sorted by the latest created records
        // The latest() method is used to sort the records in descending order by the created_at column.

        return view('index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
        // compact('data'); // compact() is a PHP function that creates an array from variables and their values
        // request()->input('page', 1) - 1) * 5); // to get the current page number
        // The with() method is used to attach the $i variable to the view.
        // The input() method is used to retrieve the value of the page parameter from the request object. 
        // If it is not present, it defaults to 1.
        // The expression (request()->input('page', 1) - 1) * 5 calculates the starting index of the data to be displayed on the current page.
    }

    // Show the form for creating a new resource i.e. student.
    public function create()
    {
        return view('create'); // create.blade.php that contains the form to create a new student record
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'username' =>  'unique:students',
            'email' =>  'email|unique:students'
        ]);
        // The validate() method validates the incoming request using the given validation rules.
        // it can be considered as server-side validation (in addition to the client-side validation)

        $student = new Student; // create a new student object

        $student->Full_name = $request->fullName; // get the value of the input field with name="fullName"
        $student->Username = $request->username; // get the value of the input field with name="username"
        $student->BirthDate = $request->birthDate; // get the value of the input field with name="birthDate"
        $student->Address = $request->address; // get the value of the input field with name="address"
        $student->Phone = $request->phone; // get the value of the input field with name="phone"
        $student->Email = $request->email; // get the value of the input field with name="email"
        $student->Password = $request->password; // get the value of the input field with name="password"

        $student->save(); // save the student object to the database
        event(new NewUserRegistered($student));

        return redirect()->route('students.index')->with('success', 'Student Added successfully.'); // redirect the user to the index page with a success message
    }
}
