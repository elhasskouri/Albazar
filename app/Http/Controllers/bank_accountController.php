<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank_account;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class bank_accountController extends Controller
{
        public function __construct()
    {
        $this->middleware('user', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        //$shop = Auth::user()->shop;
        $banks = Bank_account::where('seller_id', Auth::user()->id)->get();
        //$banks = Bank_account::all();
        return view('frontend.seller.bank_account', compact('banks'));
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(Bank_account::where('iBane', $request->iBane)->first() != null){
            flash(__('IBAN already exists!'))->error();
            return back();
        }
        
        $banks = new Bank_account;
        $banks->userName = preg_replace('/[^A-Za-z0-9\-]/', '', $request->name);
        $banks->bankName = $request->bank_name;
		$banks->bankAdresse = $request->bankAdresse;
		$banks->iBane = $request->iBane;

        if(Auth::user()->user_type == 'admin'){
             $banks->seller_id = $request->seller_id;
        }else{
            $banks->seller_id = Auth::user()->id;
        }

        $banks->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str_random(5);



        if($banks->save()){
            flash(__('Bank Account has been inserted successfully'))->success();
            if(Auth::user()->user_type == 'admin'){
                return redirect()->route('bank_accounts.admin');
            }
            else{
                return redirect()->route('seller.bank_account');
            }
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Bank_account::findOrFail($id);
        if(Bank_account::destroy($id)){

            flash(__('Product has been deleted successfully'))->success();
            if(Auth::user()->user_type == 'admin'){
                return redirect()->route('bank_accounts.admin');
            }
            else{
                return redirect()->route('seller.bank_account');
            }
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $bank = Bank_account::findOrFail($id);
        $bank->userName = $bank->userName = preg_replace('/[^A-Za-z0-9\-]/', '', $request->name);
        $bank->bankName = $request->bank_name;
        $bank->bankAdresse = $request->bankAdresse;
        $bank->iBane = $request->iBane;
        $bank->seller_id = $request->seller_id;

        if($bank->save()){
            flash(__('Product has been updated successfully'))->success();
            if(Auth::user()->user_type == 'admin'){
                return redirect()->route('bank_accounts.admin');
            }
            else{
                return redirect()->route('seller.bank_account');
            }
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function updateStatut(Request $request)
    {
        




        //$statutFalsed = Bank_account::all();

        $statutFalsed = DB::table('bank_accounts')
            ->update(array('statut' => '0'));
            

      $bank = Bank_account::findOrFail($request->id);
        $bank->statut = $request->statut;
        
       
        //return view('frontend.seller.bank_account', compact('statutFalse'));


        
        if($bank->save()){
            return 1;
        }
        return 0;
    }

    public function admin_bank_accounts() 
    {
        //$shop = Auth::user()->shop;
        //return view('frontend.seller.bank_account', compact('shop'));
        $banks = Bank_account::all();
        return view('sellers.bank_accounts', compact('banks'));
    }

    public function admin_bank_accountsCreate()
    {
        $banksName = ["BMCE Bank","Attijariwafa Bank ","Groupe Banques Populaires","Banque Marocaine pour le Commerce et l'Industrie (BMCI)","Crédit Agricole du Maroc","Crédit Immobilier et Hôtelier (CIH)","Crédit du Maroc","Société Générale (SG)","Union Marocaine des Banques (UMB)","Al Barid Bank (BDBK)","Bank Assafa","Umnia Bank","Arab Bank","BANK AL MAGHRIB","Trésorerie Générale du Royaume (TGR)","Citibank","Caixabank, (succursale au Maroc)","Caisse de Dépôt et de Gestion (CDG)","Banco de Sabadell","CFG"];
        $Users = User::all();
        return view('sellers.bank_accounts_create',compact('banksName','Users'));
    }

    public function edit($id)
    {
        $banksName = ["BMCE Bank","Attijariwafa Bank ","Groupe Banques Populaires","Banque Marocaine pour le Commerce et l'Industrie (BMCI)","Crédit Agricole du Maroc","Crédit Immobilier et Hôtelier (CIH)","Crédit du Maroc","Société Générale (SG)","Union Marocaine des Banques (UMB)","Al Barid Bank (BDBK)","Bank Assafa","Umnia Bank","Arab Bank","BANK AL MAGHRIB","Trésorerie Générale du Royaume (TGR)","Citibank","Caixabank, (succursale au Maroc)","Caisse de Dépôt et de Gestion (CDG)","Banco de Sabadell","CFG"];

        //$currentUser = User::where('id',$ids)->get();

        $Users = User::all();
        $banks = Bank_account::findOrFail(decrypt($id));
        return view('sellers.bank_accounts_edit', compact('banks','banksName','Users'));
    }



}
