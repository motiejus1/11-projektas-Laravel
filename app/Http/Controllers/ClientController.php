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
        $companies = Company::all();
        return view('client.index',['clients'=> $clients, 'companies'=> $companies]);
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

    public function storeAjax(Request $request) {
        $client = new Client;

        $client->name = $request->clientName;
        $client->surname = $request->clientSurname;
        $client->description = $request->clientDescription;
        $client->company_id = $request->clientCompany;

        $client->save();

        $success = [
            'success' => 'Client added successfully',
            'clientId' => $client->id,
            'clientName' => $client->name,
            'clientSurname' => $client->surname,
            'clientDescription' => $client->description,
            'clientCompany' => $client->clientCompany->title
        ];

        $success_json = response()->json($success);

        return $success_json;

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
        $client->delete();
        return redirect()->route("client.index");
    }

    public function destroyAjax(Client $client)
    {
        //1. IStriname klienta
        //2. Suskaiciuojame kiek klientu liko kompanijai
        //3. Likusiu klientu kieki perduodame i JSON zinute
        //4. Per Javascript, jei klientu kiekis ateina 0, remove() - table, append() - alert
        // id
        //name
        //surname
        //company_id

        $company_id = $client->company_id;

        $client->delete();

        $clientsLeft = Client::where('company_id', $company_id)->get() ;//masyvas su visais klientais, priklausanciais kompanijai
        $clientsCount = $clientsLeft->count();

        //sekmes nesekmes zinute
        $success = [
            "success" => "The Client deleted successfuly",
            "clientsCount" => $clientsCount
        ];
        $success_json = response()->json($success);

        return $success_json;
    }
}
