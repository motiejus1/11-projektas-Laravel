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
        return view("company.create");
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

        $clientsNew = $request->clientsNew; //checkbox Add Clients?

        $company = new Company;
        $company->title = $request->companyTitle;
        $company->description = $request->companyDescription;
        $company->address = $request->companyAddress;

        $company->save();

        // $kiekNorimeIvesti = 1;
        // $request->clientName  - //kiek elementu turi sis masyvas?

        $clientsInputCount = count($request->clientName);
        // $clientsInputCount = count($request->clientDescription);
        // $clientsInputCount = count($request->clientAddress);


        if($clientsNew == "1") {

            for($i = 0 ; $i < $clientsInputCount ; $i++) {
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
        $clients = $company->companyClients; //masyvas su visais klientais priklausanciais kompanijai
        $clientsCount = $clients->count();
        //visi klientai priklausantys kompanijai

        return view("company.show",['company' => $company, 'clients'=>$clients, 'clientsCount'=> $clientsCount]);
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

     // id = 7
     // 7 elementa
    public function destroy(Company $company)
    {
        //
    }

    // [1,7,3]

    public function destroySelected(Request $request) {


        //koks cia yra kinatmojo tipas?
        //Mes gauname is Javascripto JSON masyva, kaip paprastas tekstas
        //Json masyva mes turime pasiversti i PHP masyva
        //json masyvo dekodavimas: tekstas(json masyvas) => php masyva
        // $checkedCompaniesArray = json_decode( $checkedCompanies, true);
        // $request funkcija pavercia paprasta masyva
        // [1,2,3]


        //1. Pries bandymai trinti, turime patikrinti ar kompanija turi klientu
        //2. Kuriu kompaniju istrinti nepavyko?


        //Saskaitu fakturu sistema
        //invoices
        //invoices_elements
        //Invoices elements kurie su invoices

        //1. Kai trinama kompanija, kartu isitrina ir visi jos klientai

        // 1. Surasti visus kompanijai priklausancius klientus pagal rysio funkcija, ir istrinti
        // 2. pakeisti rysi

        //tas rysys registruojasi i duomenu baze, ir rysys turi tam tikrus nustatymus
        //migracijoje viena nustatyma ir mums leisti istrinti
        //migrate fresh


        $checkedCompanies = $request->checkedCompanies; // visus id

        $messages = array();

        //error 0
        //success 1

        //error - 'danger'
        //success - 'success'

        $errorsuccess = array();

        foreach($checkedCompanies as $companyId) {
            //kaip pasirinkti kompanija pagal Id?

            // $company = Company::where("id", $companyId);
            $company = Company::find($companyId);
            $clients_count = $company->companyClients->count();
            if($clients_count > 0) {
               $errorsuccess[] = 'danger';
               $messages[] = "Company ".$companyId."cannot be deleted because it has clients";

            } else {
                $deleteAction = $company->delete();
                if($deleteAction) {
                    $errorsuccess[] = 'success';
                    $messages[] = "Company ".$companyId." deleted successfully";
                } else {
                    $messages[] = "Something went wrong";
                    $errorsuccess[] = 'danger';
                }
            }
        }


        $success = [
            'success' => $checkedCompanies,
            'messages' => $messages,
            'errorsuccess' => $errorsuccess
        ];

        $success_json = response()->json($success);

        return $success_json;

    }
}
