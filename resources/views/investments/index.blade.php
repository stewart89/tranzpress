@extends('header')

@section('title', 'Befektetések')
@section('content')

<header class="page-header">
    <div class="container-fluid p-lg-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <div class="text-between ">
                <h1 class="text-white">Befektetések
                </h1>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button class="btn btn-primary btn-icon btn-lg" data-toggle="modal" data-target="#addInvestment">
                  <span class="inner-text">Új befektetés</span>
                </button>
            </div>
        </div>
    </div>
</header>

<main class="page-content pb-5">
    <nav class="px-0 navbar navbar-expand-lg d-flex">
        <div class="px-5">
            <div class="input-group select-dropdown">
                <input type="text"
                    class="form-control"
                    placeholder="Keresés..."
                    id="investments-search"
                    value="{{rawurldecode(request('search'))}}"
                    autocomplete="off"
                    style="width: 500px"
                    >
            </div>
        </div>
        <div class="">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuOrderby"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Rendezés
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuOrderby">
                    <a
                        class="dropdown-item orderby {{(request('order') == '' || request('order') == 'name')? 'selected' : '' }}"
                        href="{{ config('app.base_path') . 'investments?order=name&otype='.((request('order') == 'name' && request('otype') == 'asc')? 'desc' : 'asc').'&search='.request('search')}}"
                        data="name"
                        otype="{{request('otype')}}">
                        Név szerint
                    </a>
                    <a
                        class="dropdown-item orderby {{(request('order') == 'amount')? 'selected' : '' }}"
                        href="{{ config('app.base_path') . 'investments?order=amount&otype='.((request('order') == 'amount' && request('otype') == 'asc')? 'desc' : 'asc').'&search='.request('search')}}"
                        data="amount"
                        otype="{{request('otype')}}">
                        Ár szerint
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid px-3 px-lg-5 py-lg-0">
        <div class="card border-top-0" id="investments-list">
            @include('investments.list')
        </div>
    </div>
</main>

@include('investments.create')

<script src="{{ asset('assets/js/investments.js')}}"></script>

@endsection
