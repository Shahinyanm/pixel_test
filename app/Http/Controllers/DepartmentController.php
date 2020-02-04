<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\DepartmentRequest;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $departments = Department::orderBy('id', 'desc')->paginate(10);

        return view('dashboard.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $users = User::users()->get();

        return view('dashboard.departments.create-edit', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(DepartmentRequest $request)
    {

        $path = $this->uploadLogo();

        $department = Department::create([
            'name' => $request->name,
            'description' => $request->description,
            'logo' => $path,
        ]);

        if ($request->has('users') && !empty($request->users)) {
            $department->users()->sync($request->users);
        }

        notify()->success(__('main.department_created_successfully'));

        return redirect()->route('dashboard.departments.index');
    }

    /**
     * Upload logo to storage
     *
     * @return false|string
     */
    private function uploadLogo()
    {
        $path = null;

        if (request()->hasFile('logo')) {

            $image = request()->file('logo');
            $file_name = uniqid().'.'.$image->getClientOriginalExtension();
            $path = 'logos';
            $path = $image->storeAs($path, $file_name, 'public');

        }

        return $path;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Department  $department
     * @return Factory|View
     */
    public function edit(Department $department)
    {
        $users = User::users()->get();

        return view('dashboard.departments.create-edit', compact('department', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DepartmentRequest  $request
     * @param  Department         $department
     * @return RedirectResponse
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $department->name = $request->name;
        $department->description = $request->description;

        $path = $this->uploadLogo();

        if ($path) {
            $department->logo = $path;
        }

        $department->save();


        if ($request->has('users') && !empty($request->users)) {
            $department->users()->sync($request->users);
        }

        notify()->success(__('main.department_updated_successfully'));

        return redirect()->route('dashboard.departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Department  $department
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Department $department)
    {
        $department->delete();
        notify()->success(__('main.department_deleted_successfully'));

        return back();
    }
}
