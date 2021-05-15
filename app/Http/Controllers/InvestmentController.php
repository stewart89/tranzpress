<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;
use App\Models\InvestmentType;
use App\Http\Requests\ValidateInvestment;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $investments = $this->getInvestments($request);
        $page = 'index';
        if($request->s){
            $page = 'list';
        }

        return view('investments.'.$page, ['investments' => $investments, 'investmentTypes' => InvestmentType::all()]);
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
    public function store(ValidateInvestment $request)
    {
        $validated = (object)$request->validated();

        $investment = new Investment();
        $investment->name = $validated->name;
        $investment->type_id = $validated->investment_type;
        $investment->transaction_date = $validated->transaction_date;
        $investment->amount = $validated->amount;
        $investment->currency = $validated->currency;
        $investment->exchange_rate = $validated->exchange_rate;
        $investment->quantity = $validated->quantity;
        $investment->anual_income = $validated->anual_income;
        $investment->term = $validated->term;

        return $investment->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Investment::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateInvestment $request, $id)
    {
        $validated = (object)$request->validated();

        $investment = Investment::find($id);
        $investment->name = $validated->name;
        $investment->type_id = $validated->investment_type;
        $investment->transaction_date = $validated->transaction_date;
        $investment->amount = $validated->amount;
        $investment->currency = $validated->currency;
        $investment->exchange_rate = $validated->exchange_rate;
        $investment->quantity = $validated->quantity;
        $investment->anual_income = $validated->anual_income;
        $investment->term = $validated->term;

        return $investment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $investment = Investment::find($id);
        $investment->delete();

        return redirect('/investments')->with('success', 'Sikeres törlés!');
    }

    private function getInvestments(Request $request){

        $search = $request->search;
        $orderBy = ($request->order)? $request->order : 'name';
        $otype = ($request->otype)? $request->otype : 'asc';

        $investments = Investment::with('type');
        if($search){
            $investments->where('name', 'LIKE', "%$search%");
        }

        return $investments->orderBy($orderBy, $otype)->paginate(10)
                ->appends('search', $search)
                ->appends('order', $orderBy)
                ->appends('otype', $otype);
    }
}
