@extends('header')

@section('title', 'Dashboard')
@section('content')

<!-- Page Header -->
<header class="page-header">
    <div class="container-fluid p-lg-5">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-between ">
                <h1 class="text-white">Dashboard
                </h1>
            </div>
        </div>
    </div>
</header>

<main class="page-content">
    <div class="px-3 px-lg-5">
        <div class="card border-top-0">
            <h4 class="text-dark p-3">Összegzés:</h2>
            <div class="card-body p-0 border-top-0">
                <table class="table mb-0 table-hover">
                    <thead>
                        <tr>
                            <th>Befektetés típúsa</th>
                            <th>Daranszám</th>
                            <th>Össz érték</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($investments as $key => $investment)
                        <tr>
                            <td><b class="font-weight-bold">{{$investment->type->name}}</b></td>
                            <td>{{$investment->count}}</td>
                            <td>{{$investment->sum}} Ft.</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <td><b class="font-weight-bold">Összegzés</b></td>
                        <td>{{$totalCount}}</td>
                        <td>{{$totalSum}} Ft.</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card border-top-0 mt-5">
            <h4 class="text-dark p-3">Várható hozam:</h2>
            <div class="card-body p-0 border-top-0">
                <table class="table mb-0 table-hover">
                    <thead>
                        <tr>
                            <th>Befektetés típúsa</th>
                            <th>Várható hozam, a következő 5 év végéig.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expectedIncome as $key => $investment)
                        <tr>
                            <td><b class="font-weight-bold">{{$investment->type->name}}</b></td>
                            <td>{{$investment->income}} Ft.</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <td><b class="font-weight-bold">Összegzés</b></td>
                        <td>{{$expectedIncomeSum->totalIncome}} Ft.</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection
