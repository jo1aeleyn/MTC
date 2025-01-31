<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\UserAccount;
use App\Models\EducationalBG;
use App\Models\Emergency;
use App\Models\EmploymentHistory;
use App\Models\FamilyBG;
use App\Models\Training;
use App\Models\Application;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\SendAccountDetails;



class EmployeeController extends Controller
{
    public function index(Request $request)
{
    // Fetch distinct years from the 'date_hired' field
    $years = Employee::selectRaw('YEAR(date_hired) as year')
        ->distinct()
        ->orderBy('year', 'desc')
        ->pluck('year');

    // Fetch all employees without pagination
    $employees = Employee::where('is_archived', 0)->get();

    // Fetch applications for all employee numbers
    $employeeNumbers = $employees->pluck('emp_num'); // Get all emp_num values as a collection
    $applications = Application::whereIn('emp_num', $employeeNumbers)->get()->keyBy('emp_num'); // Map applications by emp_num

    // Add application details and format the date_hired from the application table for each employee
    foreach ($employees as $employee) {
        $employee->application = $applications->get($employee->emp_num); // Associate application
        // Use the application date_hired instead of the employee's date_hired if available
        $employee->formatted_date_hired = $employee->application 
            ? \Carbon\Carbon::parse($employee->application->date_hired)->format('Y-m-d') 
            : \Carbon\Carbon::parse($employee->date_hired)->format('Y-m-d'); // Format application date_hired or employee date_hired
    }

    // Apply year filter if a year is selected
    if ($request->has('year') && !empty($request->year)) {
        $employees = $employees->filter(function ($employee) use ($request) {
            return date('Y', strtotime($employee->date_hired)) == $request->year;
        });
    }

    // Return the view with employee data and distinct years
    return view('employees.index', compact('employees', 'years'));
}

    public function create()
    {
        // Optionally, you can pass data to the view like departments, positions, etc.
        return view('employees.create');
    }

    /**
    * Store a newly created employee record in storage.
    */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            // Personal Information
            'surname' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'sex' => 'required|string|max:10',
            'civil_status' => 'required|string|max:50',
            'nationality' => 'required|string|max:255',
            'religion' => 'nullable|string|max:255',
            'blood_type' => 'nullable|string|max:3',
            'contact_num' => 'required|string|regex:/^09\d{9}$/', // Philippine contact number format
            'email' => 'nullable|email|max:255',
            'tin_num' => 'required|string|max:50',
            'sss_num' => 'required|string|max:50',
            'pag_ibig_num' => 'required|string|max:50',
            'philhealth_num' => 'required|string|max:50',
            'tax_status' => 'required|string|max:50',
            // Address
            'house_number' => 'required|string|max:50',
            'street_name' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'province' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            // Employment Information
            'date_hired' => 'required|date',
            'position' => 'required|string|max:255',
            'referred_by' => 'nullable|string|max:255',
            'date_applied' => 'required|date',
            'dateofregularization' => 'nullable|date',
            'employment_status' => 'nullable|string|max:255',
            // Family Background
            'family_background.*.name' => 'required|string|max:255',
            'family_background.*.relationship' => 'required|string|max:255',
            'family_background.*.occupation' => 'nullable|string|max:255',
            'family_background.*.birthdate' => 'nullable|date',
            'family_background.*.age' => 'nullable|integer|min:0',
            'family_background.*.address' => 'nullable|string|max:255',
            'family_background.*.phone' => 'nullable|string|max:15',
            // Emergency Contacts
            'emergency_contacts.*.name' => 'required|string|max:255',
            'emergency_contacts.*.relationship' => 'required|string|max:255',
            'emergency_contacts.*.address' => 'required|string|max:255',
            'emergency_contacts.*.contact_num' => 'required|string|max:15',
            // Employment History fields
            'employment_history.*.date' => 'required|date',
            'employment_history.*.position' => 'required|string|max:255',
            'employment_history.*.salary' => 'required|numeric',
            'employment_history.*.superior' => 'nullable|string|max:255',
            'employment_history.*.department' => 'nullable|string|max:255',
            'employment_history.*.address' => 'nullable|string|max:255',
            'employment_history.*.company' => 'nullable|string|max:255',
            'employment_history.*.telephone' => 'nullable|string|max:15',
            'employment_history.*.reason_for_leaving' => 'nullable|string|max:255',
            //education and training
            'educational_bg.*.level' => 'required|string|max:255',
            'educational_bg.*.school' => 'required|string|max:255',
            'educational_bg.*.degree' => 'required|string|max:255',
            'educational_bg.*.year_attended_from' => 'required|string|max:4',
            'educational_bg.*.year_attended_to' => 'required|string|max:4',
            'educational_bg.*.honors_received' => 'nullable|string|max:255',
            'title.*' => 'required|string|max:255',
            'inclusive_dates.*' => 'required|string|max:255',
            'conducted_by.*' => 'required|string|max:255',
            'venue.*' => 'required|string|max:255',
        ]);

        // Generate UUID
        $uuid = Str::uuid()->toString();

        // Concatenate address
        $address = implode(', ', [
            $request->house_number,
            $request->street_name,
            $request->barangay,
            $request->city,
            $request->province,
            $request->zip_code,
            $request->country,
        ]);

        // Calculate age
        $age = Carbon::parse($request->birthdate)->age;

        $yearHired = Carbon::parse($request->date_hired)->year;

        // Get the last employee based on the year of hire and sorted by employee number in descending order
        $lastEmployee = Employee::whereYear('date_hired', $yearHired)
        ->orderBy('emp_num', 'desc') // Sort by emp_num to get the most recent one
        ->first();

        // Increment the last employee's employee number or start from 1 if no employee exists
        $increment = 1;

        if ($lastEmployee) {
            // Extract the last 4 digits from the employee number (emp_num)
            $lastEmpNum = $lastEmployee->emp_num;
            $lastNum = substr($lastEmpNum, -4); // Get the last 4 digits of the emp_num

            // Ensure the extracted number is a valid integer
            $increment = is_numeric($lastNum) ? (int) $lastNum + 1 : 1;
        }

        // Generate the new employee number
        $employmentId = sprintf('MTC%04d-%04d', $yearHired, $increment);

        // Check if the employee number already exists in the database
        while (Employee::where('emp_num', $employmentId)->exists()) {
            // If the employee number exists, increment the number and check again
            $increment++;
            $employmentId = sprintf('MTC%04d-%04d', $yearHired, $increment);
        }

        // Check for duplicate records
        if (Employee::where('contact_num', $request->contact_num)->exists()) {
            return redirect()->back()->withErrors(['contact_num' => 'The contact number is already associated with another employee.']);
        }

        if (Employee::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'The email is already associated with another employee.']);
        }

        if (Employee::where('tin_num', $request->tin_num)->exists()) {
            return redirect()->back()->withErrors(['tin_num' => 'The TIN number is already associated with another employee.']);
        }

        // Create employee record
        $employee = Employee::create([
            'uuid' => $uuid,
            'emp_num' => $employmentId,
            'surname' => $request->surname,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'nickname' => $request->nickname,
            'birthdate' => $request->birthdate,
            'birthplace' => $request->birthplace,
            'age' => $age,
            'sex' => $request->sex,
            'civil_status' => $request->civil_status,
            'nationality' => $request->nationality,
            'religion' => $request->religion,
            'blood_type' => $request->blood_type,
            'address' => $address,
            'contact_num' => $request->contact_num,
            'email' => $request->email,
            'tin_num' => $request->tin_num,
            'sss_num' => $request->sss_num,
            'pag_ibig_num' => $request->pag_ibig_num,
            'philhealth_num' => $request->philhealth_num,
            'tax_status' => $request->tax_status,
            'created_by' => 1
        ]);

        // Automatically create user account
        $username = strtolower("{$request->first_name}_{$request->surname}_{$yearHired}");
        $password = "{$request->surname}@MTC_" . Carbon::parse($request->birthdate)->format('Y');

        UserAccount::create([
            'uuid' => $uuid,
            'username' => $username,
            'password' => Hash::make($password),
            'user_role' => 'employee',
            'email' => $request->email,
            'created_by' => auth()->id()
        ]);

        $dateOfRegularization = Carbon::parse($request->date_hired)->addMonths(6)->format('Y-m-d');

        // After employee is created, save the application data
        $application = Application::create([
            'emp_num' => $employmentId, // The employee number created earlier
            'referred_by' => $request->referred_by,
            'date_applied' => $request->date_applied,
            'date_hired' => $request->date_hired,
            'position' => $request->position,
            'EmploymentStatus' => $request->employment_status,
            'DateOfRegularization' => $dateOfRegularization,
        ]);

        // Save educational background
        if ($request->has('educational_bg')) {
            foreach ($request->educational_bg as $educational) {
                EducationalBG::create([
                    'emp_num' => $employee->emp_num,
                    'level' => $educational['level'],
                    'school' => $educational['school'],
                    'degree' => $educational['degree'],
                    'year_attended_from' => $educational['year_attended_from'],
                    'year_attended_to' => $educational['year_attended_to'],
                    'honors_received' => $educational['honors_received'],
                ]);
            }
        }

        // Save training records
        if ($request->has('title')) {
            foreach ($request->title as $index => $title) {
                Training::create([
                    'emp_num' => $employee->emp_num,
                    'title' => $title,
                    'inclusive_dates' => $request->inclusive_dates[$index],
                    'conducted_by' => $request->conducted_by[$index],
                    'venue' => $request->venue[$index],
                ]);
            }
        }

        // Save employment history
        if ($request->has('employment_history')) {
            foreach ($request->employment_history as $history) {
                EmploymentHistory::create([
                    'emp_num' => $employee->emp_num,
                    'date' => $history['date'],
                    'position' => $history['position'],
                    'salary' => $history['salary'],
                    'superior' => $history['superior'],
                    'department' => $history['department'],
                    'address' => $history['address'],
                    'company' => $history['company'],
                    'telephone' => $history['telephone'],
                    'reason_for_leaving' => $history['reason_for_leaving'],
                ]);
            }
        }

        // Save family background
        if ($request->has('family_background')) {
            foreach ($request->family_background as $family) {
                // Calculate the age from birthdate
                $age = Carbon::parse($family['birthdate'])->age;

                FamilyBG::create([
                    'emp_num' => $employee->emp_num,
                    'name' => $family['name'],
                    'relationship' => $family['relationship'],
                    'occupation' => $family['occupation'],
                    'birthdate' => $family['birthdate'],
                    'age' => $age,
                    'address' => $family['address'],
                    'phone' => $family['phone'],
                ]);
            }
        }

        // Save emergency contacts
        if ($request->has('emergency_contacts')) {
            foreach ($request->emergency_contacts as $contact) {
                Emergency::create([
                    'emp_num' => $employee->emp_num,
                    'name' => $contact['name'],
                    'relationship' => $contact['relationship'],
                    'address' => $contact['address'],
                    'contact_num' => $contact['contact_num'],
                ]);
            }
        }

        Log::info('Sending account details to email: ' . $request->email);
        Log::info('Username: ' . $username);
        Log::info('Password: ' . $password);

        if ($request->email) {
            Mail::to($request->email)->send(new SendAccountDetails($username, $password));
        }

        // Redirect with a success message
        return redirect()->route('employees.index')->with('success', 'Employee successfully added.');
    }
    public function edit($uuid)
    {
        // Fetch the employee with the given uuid
        $employee = Employee::where('uuid', $uuid)->firstOrFail();

        // Fetch the associated data based on emp_num
        $education = EducationalBG::where('emp_num', $employee->emp_num)->get();
        $employment = EmploymentHistory::where('emp_num', $employee->emp_num)->get();
        $family = FamilyBG::where('emp_num', $employee->emp_num)->get();
        $training = Training::where('emp_num', $employee->emp_num)->get();
        $emergencyContacts = Emergency::where('emp_num', $employee->emp_num)->get();
        $application = Application::where('emp_num', $employee->emp_num)->firstOrFail();
        $company = Company::where('emp_num', $employee->emp_num)->first(); // This might be null

        // Ensure $company is always an object, even if it's null
        $company = $company ?? new Company();

        // Pass the employee data to the view
        return view('employees.edit', compact(
            'employee',
            'education',
            'employment',
            'family',
            'training',
            'emergencyContacts',
            'application',
            'company' // Now guaranteed to be an object
        ));
    }


    public function update(Request $request, $uuid)
    {
        // Validate the request data (same as store method)
        $request->validate([
            // Personal Information
            'surname' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'sex' => 'required|string|max:10',
            'civil_status' => 'required|string|max:50',
            'nationality' => 'required|string|max:255',
            'religion' => 'nullable|string|max:255',
            'blood_type' => 'nullable|string|max:3',
            'contact_num' => 'required|string|regex:/^09\d{9}$/', // Philippine contact number format
            'email' => 'nullable|email|max:255',
            'tin_num' => 'required|string|max:50',
            'sss_num' => 'required|string|max:50',
            'pag_ibig_num' => 'required|string|max:50',
            'philhealth_num' => 'required|string|max:50',
            'tax_status' => 'required|string|max:50',

            // Address
            'address' => 'required|string|max:255',

            // Employment Information
            'date_hired' => 'required|date',
            'position' => 'required|string|max:255',
            'referred_by' => 'nullable|string|max:255',
            'date_applied' => 'required|date',
            'employment_status' => 'nullable|string|max:255',
            // Family Background
            'family_background.*.name' => 'required|string|max:255',
            'family_background.*.relationship' => 'required|string|max:255',
            'family_background.*.occupation' => 'nullable|string|max:255',
            'family_background.*.birthdate' => 'nullable|date',
            'family_background.*.age' => 'nullable|integer|min:0',
            'family_background.*.address' => 'nullable|string|max:255',
            'family_background.*.phone' => 'nullable|string|max:15',
            // Emergency Contacts
            'emergency_contacts.*.name' => 'required|string|max:255',
            'emergency_contacts.*.relationship' => 'required|string|max:255',
            'emergency_contacts.*.address' => 'required|string|max:255',
            'emergency_contacts.*.contact_num' => 'required|string|max:15',
            // Employment History fields
            'employment_history.*.date' => 'required|date',
            'employment_history.*.position' => 'required|string|max:255',
            'employment_history.*.salary' => 'required|numeric',
            'employment_history.*.superior' => 'nullable|string|max:255',
            'employment_history.*.department' => 'nullable|string|max:255',
            'employment_history.*.address' => 'nullable|string|max:255',
            'employment_history.*.company' => 'nullable|string|max:255',
            'employment_history.*.telephone' => 'nullable|string|max:15',
            'employment_history.*.reason_for_leaving' => 'nullable|string|max:255',
            // Education and Training
            'educational_bg.*.level' => 'required|string|max:255',
            'educational_bg.*.school' => 'required|string|max:255',
            'educational_bg.*.degree' => 'required|string|max:255',
            'educational_bg.*.year_attended_from' => 'required|string|max:4',
            'educational_bg.*.year_attended_to' => 'required|string|max:4',
            'educational_bg.*.honors_received' => 'nullable|string|max:255',
            'title.*' => 'required|string|max:255',
            'inclusive_dates.*' => 'required|string|max:255',
            'conducted_by.*' => 'required|string|max:255',
            'venue.*' => 'required|string|max:255',
             // Company Information
            'AccessCard_release' => 'nullable|date',
            'AccesCard_return' => 'nullable|date',
            'CompanyEmail' => 'nullable|string|max:255',
            'PayrollAccount' => 'nullable|string|max:255',
            'Cocolife_HMO' => 'nullable|string|max:255',
            'Cocolife_ReleaseDate' => 'nullable|date',
            'Cocolife_ReturnDate' => 'nullable|date',
        ]);

        // Fetch the employee record based on uuid
        $employee = Employee::where('uuid', $uuid)->firstOrFail();

        // Update the employee record
        $employee->update([
            'surname' => $request->surname,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'nickname' => $request->nickname,
            'birthdate' => $request->birthdate,
            'sex' => $request->sex,
            'civil_status' => $request->civil_status,
            'nationality' => $request->nationality,
            'religion' => $request->religion,
            'blood_type' => $request->blood_type,
            'contact_num' => $request->contact_num,
            'email' => $request->email,
            'tin_num' => $request->tin_num,
            'sss_num' => $request->sss_num,
            'pag_ibig_num' => $request->pag_ibig_num,
            'philhealth_num' => $request->philhealth_num,
            'tax_status' => $request->tax_status,
            'address' => $request->address,
            'edited_by' =>auth()->id()
        ]);

        $company = Company::updateOrCreate(
            ['emp_num' => $employee->emp_num], // Ensure unique company record per employee
            [
                'AccessCard_release' => $request->AccessCard_release,
                'AccesCard_return' => $request->AccesCard_return,
                'CompanyEmail' => $request->CompanyEmail,
                'PayrollAccount' => $request->PayrollAccount,
                'Cocolife_HMO' => $request->Cocolife_HMO,
                'Cocolife_ReleaseDate' => $request->Cocolife_ReleaseDate,
                'Cocolife_ReturnDate' => $request->Cocolife_ReturnDate,
            ]
        );
        // Update educational background
    if ($request->has('educational_bg')) {
        foreach ($request->educational_bg as $educational) {
            EducationalBG::updateOrCreate(
                ['emp_num' => $employee->emp_num, 'level' => $educational['level']], // Ensure unique record per level
                [
                    'level' => $educational['level'],
                    'school' => $educational['school'],
                    'degree' => $educational['degree'],
                    'year_attended_from' => $educational['year_attended_from'],
                    'year_attended_to' => $educational['year_attended_to'],
                    'honors_received' => $educational['honors_received'],
                ]
            );
        }
    }

    if ($request->has('title')) {
        foreach ($request->title as $index => $title) {
            Training::updateOrCreate(
                ['emp_num' => $employee->emp_num, 'title' => $title], // Ensure unique record
                [
                    'title' => $title,
                    'inclusive_dates' => $request->inclusive_dates[$index],
                    'conducted_by' => $request->conducted_by[$index],
                    'venue' => $request->venue[$index],
                    'edited_by' => auth()->id()
                ]
            );
        }
    }

   // Update family background
   if ($request->has('family_background')) {
    foreach ($request->family_background as $familyBackground) {
        // If you want to associate the family background with the employee
        FamilyBG::updateOrCreate(
            [
                'emp_num' => $employee->emp_num,
                'name' => $familyBackground['name'], // Ensure uniqueness based on name
                'relationship' => $familyBackground['relationship']
            ],
            [
                'occupation' => $familyBackground['occupation'],
                'birthdate' => $familyBackground['birthdate'],
                'address' => $familyBackground['address'],
                'phone' => $familyBackground['phone'],
                'edited_by' => auth()->id()
            ]
        );
    }
}
      // Update emergency contacts
      if ($request->has('emergency_contacts')) {
        foreach ($request->emergency_contacts as $emergencyContact) {
            // If you want to associate the emergency contact with the employee
            Emergency::updateOrCreate(
                [
                    'emp_num' => $employee->emp_num,
                    'name' => $emergencyContact['name'], // Ensure uniqueness based on name
                    'relationship' => $emergencyContact['relationship']
                ],
                [
                    'address' => $emergencyContact['address'],
                    'contact_num' => $emergencyContact['contact_num'],
                    'edited_by' => auth()->id()
                ]
            );
        }
    }
    // Fetch the existing application record
$application = Application::where('emp_num', $employee->emp_num)->first();

// Update the existing application record
if ($application) {
    $application->update([
        'referred_by' => $request->referred_by,
        'date_applied' => $request->date_applied,
        'date_hired' => $request->date_hired,
        'position' => $request->position,
        'EmploymentStatus' => $request->employment_status,
    ]);
} else {
    // If no application record exists, you can create a new one (if necessary)
    Application::create([
        'emp_num' => $employee->emp_num,
        'referred_by' => $request->referred_by,
        'date_applied' => $request->date_applied,
        'date_hired' => $request->date_hired,
        'position' => $request->position,
        'EmploymentStatus' => $request->employment_status,
    ]);
}

     // Save or update the employment history
     if ($request->has('employment_history')) {
        foreach ($request->employment_history as $employment) {
            EmploymentHistory::updateOrCreate(
                [
                    'emp_num' => $employee->emp_num,
                    'company' => $employment['company'], // Ensure uniqueness based on company name
                    'position' => $employment['position'],
                    'date' => $employment['date']
                ],
                [
                    'salary' => $employment['salary'],
                    'superior' => $employment['superior'],
                    'department' => $employment['department'],
                    'address' => $employment['address'],
                    'telephone' => $employment['telephone'],
                    'reason_for_leaving' => $employment['reason_for_leaving'],
                    'edited_by' => auth()->id(),
                ]
            );
        }
    }
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function show($uuid)
{
    // Fetch the employee record
    $employee = Employee::where('uuid', $uuid)->firstOrFail();

    // Fetch related data based on the employee's emp_num
    $application = Application::where('emp_num', $employee->emp_num)->first();
    $education = EducationalBG::where('emp_num', $employee->emp_num)->get(); // Assuming multiple education entries
    $employment = EmploymentHistory::where('emp_num', $employee->emp_num)->get(); // Assuming multiple employment history entries
    $family = FamilyBG::where('emp_num', $employee->emp_num)->get(); // Assuming multiple family entries
    $training = Training::where('emp_num', $employee->emp_num)->get(); // Assuming multiple training entries
    $emergencyContacts = Emergency::where('emp_num', $employee->emp_num)->get(); // Assuming multiple emergency contacts
    $user = Auth::user();
    // Attach additional data to the employee
    $employee->application = $application;
    $employee->education = $education;
    $employee->employment = $employment;
    $employee->family = $family;
    $employee->training = $training;
    $employee->emergencyContacts = $emergencyContacts;

    // Pass data to the view
    return view('employees.show', compact('employee','user'));
}

    public function archive($uuid)
    {
        try {
            // Fetch the employee record
            $employee = Employee::where('uuid', $uuid)->firstOrFail();

            // Check if the employee is already archived
            if ($employee->is_archived) {
                return redirect()->route('employees.index')
                    ->with('error', 'This employee is already archived.');
            }

            // Mark the employee as archived
            $employee->update([
                'is_archived' => 1,
                'archived_by' => auth()->id()
            ]);

            return redirect()->route('employees.index')
                ->with('success', 'Employee archived successfully.');
        } catch (\Exception $e) {
            // Handle errors and return an error message
            return redirect()->route('employees.index')
                ->with('error', 'An error occurred while trying to archive the employee.');
        }
    }


}
