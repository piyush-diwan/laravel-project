<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DeptController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        if ($search) {
            $departments = Department::where('dept_name', 'like', "%$search%")
                ->orWhere('dept_code', 'like', "%$search%")
                ->paginate(10);
        } else {    
            $departments = Department::paginate(10);
        }
        return view('department.index',compact('departments'));
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dept_code' => 'required|string|unique:departments,dept_code',
            'dept_name' => 'required|string|max:50|unique:departments,dept_name',
            'description' => 'nullable|string|max:500',
        ]);

        $department = new Department();
        $department->dept_code = $request->dept_code;
        $department->dept_name = $request->dept_name;
        $department->description = $request->description;
        $department->save();

        return redirect()->route('department.index')->with('success', 'Department created successfully.');
    }

    public function edit($id){
        $department = Department::findOrFail(($id));
        return view('department.edit', compact('department'));
    }

    public function update(Request $request , $id)
    {
        $request->validate([
            'dept_code' => 'required|string|unique:departments,dept_code,'.$id,
            'dept_name' => 'required|string|max:50|unique:departments,dept_name,'.$id,
            'description' => 'nullable|string|max:500',
        ],
        [
            'dept_code.unique' => 'This department code has already been taken.',
            'dept_name.unique' => 'This department name has already been taken. Please choose a different name.',
        ]
        
    );
        
        $department = Department::findorFail($id);
        $department->dept_code = $request->dept_code;
        $department->dept_name = $request->dept_name;
        $department->description = $request->description;
        $department->save();

        return redirect()->route('department.index')->with('success', "Department $department->dept_name updated successfully.");
    }

    public function destroy($id)
    {
        $department = Department::findorfail($id);
        $department->delete();
        return redirect()->route('department.index')->with('success'."Department $department->dept_name deleted successfully.");
    }
}
