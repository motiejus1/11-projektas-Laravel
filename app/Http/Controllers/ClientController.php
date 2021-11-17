<?php

namespace App\Http\Controllers;

use App\Client;
use App\Company;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('client.index',['clients'=> $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view("client.create", ['companies'=> $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $companyNew = $request->companyNew; // 1 arba false
        // jeigu companyNew == 1(pazymetas) vykdomas naujos kompanijos pridejimas
        // kitu atveju kompanija yra imama is select

        // return $companyNew;

        if($companyNew == "1") { // koks kintamojo tipas ateina is checkbox jei jis pazymetas? 1 tekstas
            $company = new Company;
            $company->title =  $request->companyTitle;
            $company->description = $request->companyDescription;
            $company->address = $request->companyAddress;
            $company->save();

            $companyId = $company->id;
        } else {
            $companyId = $request->clientCompany;
        }


        $client = new Client;

        $client->name = $request->clientName;
        $client->surname = $request->clientSurname;
        $client->description = $request->clientDescription;
        $client->company_id = $companyId;

        $client->save();

        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
