<?php

namespace App\Http\Controllers;

use App\Company;
use App\Client;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index', ['companies'=>$companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ivesti kompanija be klientu x
        //ivesti kompanja su vienu klientu x
        //ivesti kompanija su n+1 klientu x

        $clientsNew = $request->clientsNew;

        $company = new Company;
        $company->title = $request->companyTitle;
        $company->description = $request->companyDescription;
        $company->address = $request->companyAddress;

        $company->save();

        $kiekNorimeIvesti = 1;

        if($clientsNew == "1") {

            for($i = 0 ; $i = $kiekNorimeIvesti ; $i++) {
                $client = new Client;
                $client->name = $request->clientName[$i];
                $client->surname = $request->clientSurname[$i];
                $client->description = $request->clientDescription[$i];
                $client->company_id = $company->id; //nuo jokio if'o nepriklauso
                $client->save();
            }
        }

        return redirect()->route("company.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $clients = $company->companyClients;
        //visi klientai priklausantys kompanijai
        return view("company.show",['company' => $company, 'clients'=>$clients]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
