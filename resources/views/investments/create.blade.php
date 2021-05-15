<div class="modal fade" id="addInvestment" tabindex="-1" role="dialog" aria-labelledby="Új befektetés" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="investment-modal-title">Új befektetés</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Bezár">
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12 col-lg-6 border-right">

                            <div class="form-group required">
                                <label>Név</label>
                                <div class="input-group select-dropdown">
                                    <input type="text" id="name" class="form-control" autocomplete="off">
                                </div>
                                <div class="invalid-feedback" id="investment-name-empty">A név megadása kötelező</div>
                            </div>

                            <div class="form-group required">
                                <label>Befektetés tipusa</label>
                                <div class="input-group mb-3">
                                    <select id="investment-type" class="custom-select form-control">
                                        @foreach($investmentTypes as $investmentType)
                                            <option value="{{$investmentType->id}}">{{$investmentType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group required">
                                <label>Tranzakció dátuma</label>
                                <div class="input-group select-dropdown">
                                    <input type="text" id="transaction-date" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group required">
                                <label>Befektetett összeg</label>
                                <div class="input-group select-dropdown">
                                    <input type="text" id="amount" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group required">
                                <label>Deviza</label>
                                <div class="input-group mb-3">
                                    <select id="currency" class="custom-select form-control">
                                        <option value="HUF" selected>HUF</option>
                                        <option value="EUR">EUR</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="col-12 col-lg-6">

                            <div class="form-group" id="exchange-rate-div" style="display: none">
                                <label>Árfolyam</label>
                                <div class="input-group select-dropdown">
                                    <input type="text" id="exchange-rate" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group required">
                                <label>Vásárolt mennyiség</label>
                                <div class="input-group select-dropdown">
                                    <input type="text" id="quantity" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group required">
                                <label>Tervezett éves hozam</label>
                                <div class="input-group select-dropdown">
                                    <input type="text" id="anual-income" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tervezett futamidő</label>
                                <div class="input-group select-dropdown">
                                    <input type="text" id="term" class="form-control" autocomplete="off">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light d-none d-sm-inline-flex" data-dismiss="modal">Mégsem</button>
                <button type="button" id="investment-save" class="btn btn-primary">
                    <span class="spinner-border spinner-border-sm" id="save-spin" style="display: none;"></span>
                    Mentés
                </button>
            </div>
        </div>
    </div>
</div>
