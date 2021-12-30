<?php

namespace App\Http\Controllers;

use App\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Companies::latest()->paginate(5);
        return view ('company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyCreateRequest $request)
    {
        $request->validated();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('company');

            Companies::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $logo,
            ]);
        }

        return redirect()->route('company.index')->with('success', 'Created successfully');
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
        $company = Companies::findOrFail($id);

        return view('Company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, $id)
    {
       $company = Companies::whereId($id);

        $request->validated();

        if ($request->hasFile('logo')) {
        
            if($request->oldLogo) 
            {
                Storage::delete($request->oldLogo);
            }

            $logo = $request->file('logo')->store('company');

            $company->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $logo,
            ]);
        }

        $company->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'website' => $request->website,
        ]);

        return redirect()->route('company.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Companies::findOrFail($id);

        if($company->logo) 
        {
          Storage::delete($company->logo);
        }

        $company->delete();

        return redirect()->route('company.index')->with('success', 'Deleted successfully');
    }
}
