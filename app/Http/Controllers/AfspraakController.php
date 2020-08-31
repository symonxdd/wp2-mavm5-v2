<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Afspraak;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

use routes;
use Session;

class AfspraakController extends Controller
{
    public function getIndex()
    {
        return view('app.index');
    }

    public function getAfspraken() {

        // source: https://laravel.com/docs/7.x/queries#joins
        $afspraken = DB::table('afspraken')
            ->join('patienten', 'patienten.id', '=', 'afspraken.patient_id')
            ->select(
                'afspraken.id',
                'afspraken.datum',
                'afspraken.tijdstip',
                'patienten.voornaam',
                'patienten.naam',
                'patienten.contact_met_coronavirus'
                )
            ->paginate(5);
        // $afspraken = Afspraak::paginate(3);
        return view('app.afspraken', ['afspraken' => $afspraken]);

        /** 
             * Deze INNER JOIN is equivalent aan de MySQL versie:
             * 
             * SELECT 
             *   a.id,
             *   a.datum,
             *   a.tijdstip,
             *   p.voornaam,
             *   p.naam,
             *   p.contact_met_coronavirus
             *  FROM
             *   patienten p
             *  INNER JOIN afspraken a
             *   ON p.id = a.patient_id;
             * 
             */
    }

    public function postAddAfspraak(Request $request) {
        $this->validate($request, [

            // string validatie werkt niet, we gebruiken in de plaats de `pattern` en `title` attributen in HTML
            // source: https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/pattern

            // `|string|min:3|max:50`
            'voornaam'  => 'required',
            'naam'      => 'required',
            'datum'     => 'required|date|date_format:Y-m-d|after_or_equal:2020-08-06|before_or_equal:2021-08-06',
            'tijdstip'  => 'required|before:'.'20:01|after:'.'06:59'
        ]);

        $patientQuery = DB::table('patienten')
                    ->where('voornaam','=', $request->input('voornaam'))
                    ->where('naam','=', $request->input('naam'))
                    ->get();

        if ($patientQuery->isEmpty()) {
            $patient = new Patient;
            $patient->voornaam = $request->input('voornaam');
            $patient->naam = $request->input('naam');
            $patient->contact_met_coronavirus = $request->input('corona');
            $patient->save();
            $this->maakAfspraak($patient->id, $request);
        }
        else {
            $this->maakAfspraak($patientQuery[0]->id, $request);
        }

        return redirect()->back();
    }

    public function maakAfspraak($id, $request) {
        $afspraak = new Afspraak();
        $afspraak->patient_id = $id;
        $afspraak->datum = $request->input('datum');
        $afspraak->tijdstip = $request->input('tijdstip');
        $afspraak->save();
    }

    public function postWijzigAfspraak(Request $request) {
        switch ($request->input('action')) {
            case 'd':
                    $afspraak = Afspraak::find($request->input('afspraak_id'));
                    $afspraak->delete();
                    return redirect()->back();
                break;
    
            case 'e':

                // dd($request->input('corona'));

                $this->validate($request, [
                    'voornaam'  => 'required', 
                    'naam'      => 'required',
                    'datum'     => 'required|date|date_format:Y-m-d|after_or_equal:2020-08-06|before_or_equal:2021-08-06',
                    'tijdstip'  => 'required|before:'.'20:01|after:'.'06:59'
                ]);

                $afspraak = Afspraak::find($request->input('afspraak_id'));
                $patient = Patient::find($afspraak->patient_id);

                $patient->voornaam = $request->input('voornaam');
                $patient->naam = $request->input('naam');

                $patient->contact_met_coronavirus = $request->input('corona');

                $afspraak->datum = $request->input('datum');
                $afspraak->tijdstip = $request->input('tijdstip');

                $afspraak->save();
                $patient->save();
                break;
        }

        return redirect()->back();
    }

    public function orderByDate() {
        $afspraken = DB::table('afspraken')
            ->join('patienten', 'patienten.id', '=', 'afspraken.patient_id')
            ->select(
                'afspraken.id',
                'afspraken.datum',
                'afspraken.tijdstip',
                'patienten.voornaam',
                'patienten.naam',
                'patienten.contact_met_coronavirus'
                )
            ->orderBy('datum', 'asc')
            ->get();

        return view('app.afspraken', ['afspraken' => $afspraken]);
    }
    
    public function getCart() {
        // if (!Session::has('cart')) {
        //     return view('shop.shopping-cart');
        // }
        // $oldCart = Session::get('cart');
        // $cart = new Cart($oldCart);
        // return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    // bestelling plaatsen
    public function postCheckout(Request $request) {
        // if (!Session::has('cart')) {
        //     return redirect()->route('shop.shoppingCart');
        // }

        // $oldCart = Session::get('cart');
        // $cart = new Cart($oldCart);
        // $total = $cart->totalPrice;

        // $order = new Order();

        // serialize() = neem PHP object en zet om naar een string
        // $order->cart = serialize($cart);

        // $order->name = $request->input('name');
        // $order->address = $request->input('address');
        // $order->sum = $request->input('sum');

        // if(Auth::id() == null) {
        //     $order->user_id = 1;
        // } else {
        //     $order->user_id = Auth::id();
        // }

        // $order->save();
        return redirect()->route('afspraak.index')->with('success', 'Purchase Successful');
        // return redirect()->route('product.index')->with('success', 'Purchase Successful');
    }
}
