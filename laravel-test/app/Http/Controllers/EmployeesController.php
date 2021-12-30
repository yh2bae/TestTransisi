<?php

namespace App\Http\Controllers;

use PDF;
use App\Companies;
use App\Employees;
use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\EmployeesRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ImportExcelRequest;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::latest()->paginate(5);
        return view ('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Companies::all();

        return view('Employees.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesRequest $request)
    {
        $request->validated();

        Employees::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('employees.index')->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employees::findOrFail($id);
        $company = Companies::all();

        return view('employees.edit', compact('employees','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesRequest $request, $id)
    {
        $employees = Employees::whereId($id);

        $employees->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('employees.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employees::findOrFail($id);

        $employees->delete();

        return redirect()->route('employees.index')->with('success', 'Deleted successfully');
    }

    public function createPDF()
    {
        $employees = Employees::all();

        $pdf = PDF::loadView('employees/pdf', compact('employees'));

        return $pdf->download('employees-file.pdf');
    }

    public function exportExcel()
	{
		return Excel::download(new EmployeesExport, 'employees.xlsx');
	}

    public function importExcel(ImportExcelRequest $request)
    {
        $request->validated();

        $file = $request->file('file');
        $nameFile = rand().$file->getClientOriginalName();
        $file->move('employees',$nameFile);

        Excel::import(new EmployeesImport, public_path('/employees/'.$nameFile));

        Session::flash('success','Employee Data Imported Successfully!');

        return redirect()->back();
    }
}
