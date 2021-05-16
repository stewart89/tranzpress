<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investments = $this->getSummary();
        $expectedIncome = $this->expectedIncome();

        return view('dashboard', array_merge([
            'investments' => $investments,
            'totalCount' => Investment::count(),
            'totalSum' => Investment::sum('amount'),
            ], $expectedIncome)
        );
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getSummary(){

        return Investment::select('*', DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as sum'))->with('type')->groupBy('type_id')->get();
    }

    private function expectedIncome(){

        $expectedIncome = Investment::select('*', DB::raw('SUM(calculate_income(5, transaction_date, amount, currency, exchange_rate, anual_income)) as income'))
                    ->with('type')->groupBy('type_id')->get();

        $expectedIncomeSum = Investment::select(DB::raw('SUM(calculate_income(5, transaction_date, amount, currency, exchange_rate, anual_income)) as totalIncome'))->first();

        return ['expectedIncome' => $expectedIncome,
               'expectedIncomeSum' => $expectedIncomeSum,
            ];
    }

}
