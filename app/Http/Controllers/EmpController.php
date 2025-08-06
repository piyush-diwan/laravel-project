<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmpController extends Controller
{
   
    public function index(Request $request)
    {
        $search = $request->input('search');
        $department = $request->input('department');
        
        $employees = Employee::when($search, function($query) use ($search) {
                return $query->where('name', 'like', "%$search%")
                             ->orWhere('email', 'like', "%$search%");
            })
            ->when($department, function($query) use ($department) {
                return $query->where('department', $department);
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        $departments = Department::pluck('dept_name', 'dept_code')->toArray();
        return view('employee.index', compact('employees','departments'));
    }

    
    //   Show the form for creating a new employee
    public function create()
    {
        $departments = Department::pluck('dept_name', 'dept_code')->toArray();
        return view('employee.create', compact('departments'));
    }

    /**
     * Store a newly created employee
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'department' => 'required|string',
            'position' => 'required|string|max:255',
            'join_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->department = $request->department;
        $employee->position = $request->position;
        $employee->join_date = $request->join_date;
        $employee->status = 'active';

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('employee_photos', 'public');
            $employee->photo = $photoPath;
        }

        $employee->save();

        return redirect()->route('employee.index')
                        ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified employee
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::pluck('dept_name', 'dept_code')->toArray();
        return view('employee.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified employee
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,'.$id,
            'department' => 'required|string',
            'position' => 'required|string|max:255',
            'join_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->department = $request->department;
        $employee->position = $request->position;
        $employee->join_date = $request->join_date;
        $employee->status = $request->status;

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }
            
            $photoPath = $request->file('photo')->store('employee_photos', 'public');
            $employee->photo = $photoPath;
        }

        $employee->save();

        return redirect()->route('employee.index')
                        ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified employee
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        
        // Delete photo if exists
        if ($employee->photo) {
            Storage::disk('public')->delete($employee->photo);
        }
        
        $employee->delete();

        return redirect()->route('employee.index')
                        ->with('success', 'Employee deleted successfully.');
    }

}