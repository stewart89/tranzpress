dateSettings = {
    "format": "YYYY-MM-DD",
    "separator": " - ",
    "applyLabel": "Ok",
    "cancelLabel": "Mégse",
    "fromLabel": "From",
    "toLabel": "To",
    "customRangeLabel": "Custom",
    //"weekLabel": "W",
    "daysOfWeek": [
        "V",
        "H",
        "K",
        "Sz",
        "Cs",
        "P",
        "Sz"
    ],
    "monthNames": [
        "Január",
        "Február",
        "Március",
        "Április",
        "Május",
        "Június",
        "Július",
        "Augusztus",
        "Szeptember",
        "Október",
        "November",
        "December"
    ],
    //"firstDay": 1
}

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "rtl": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": 200,
    "hideDuration": 800,
    "timeOut": 5000,
    "extendedTimeOut": 500,
    "showEasing": "linear",
    "hideEasing": "linear",
    "showMethod": "slideDown",
    "hideMethod": "fadeOut"
 }

 requiredFileds = [
     {
        id: 'name',
        msg: 'A név megadása kötelező',
     },
     {
        id: 'transaction-date',
        msg: 'A tranzakció dátuma megadása kötelező',
     },
     {
        id: 'amount',
        msg: 'A befektetett összeg megadása kötelező',
     },
     {
        id: 'quantity',
        msg: 'A vásárolt mennyiség megadása kötelező',
     },
     {
        id: 'anual-income',
        msg: 'A tervezett éves hozam megadása kötelező',
     }
];
