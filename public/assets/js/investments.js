document.addEventListener('DOMContentLoaded', () => {

    $('#transaction-date').daterangepicker({
        "singleDatePicker": true,
        "autoUpdateInput": true,
        "autoApply": true,
        locale: dateSettings,
    });

    /**
     * Search for user
     */
     document.getElementById('investments-search').addEventListener('keyup', () => {

        let search = document.getElementById('investments-search').value;
        let orderByItems = document.getElementsByClassName('orderby');
        let orderBy = 'name';
        let orderType = 'asc';
        Array.from(orderByItems).forEach(element => {
            if(element.className.indexOf('selected') > -1){
                orderBy = element.getAttribute('data');
                orderType = element.getAttribute('otype');
            }

            let paramsString = element.getAttribute('href');
            var searchParams = new URLSearchParams(paramsString);
            searchParams.set('search', search);
            if(search == ''){
                searchParams.delete('search');
            }
            element.setAttribute('href', decodeURIComponent(searchParams.toString()));
        });

        toastr.clear();
        axios.get('investments?s=1&search=' + search + '&order='+orderBy + '&otype='+ orderType, config).then(function (response) {

            document.getElementById('investments-list').innerHTML = response.data;
            addeventForActionMenu();
            initToolTips();
            if(response.data.indexOf('<td') === -1){
                toastr.info(__lang.client.notFound);
            }
        }).catch(function (error) {
            console.log(error);
        })
    });

    let __investmentId = false;
    document.getElementById('investment-save').addEventListener('click', () => {

        let data = {};
        data.name = document.getElementById('name').value;
        data.investment_type = document.getElementById('investment-type').options[document.getElementById('investment-type').selectedIndex].value;
        data.transaction_date = document.getElementById('transaction-date').value;
        data.amount = document.getElementById('amount').value;
        data.currency = document.getElementById('currency').options[document.getElementById('currency').selectedIndex].value;
        data.exchange_rate = document.getElementById('exchange-rate').value;
        data.quantity = document.getElementById('quantity').value;
        data.anual_income = document.getElementById('anual-income').value;
        data.term = document.getElementById('term').value;

        if(!checkFieldIsNotEmpty()){
            return false;
        }

        if(data.currency !== 'HUF' && !data.exchange_rate){
            toastr.error('Az árfolyam megadása kötelező', 'Form validációs hiba');
            return false;
        }

        axios({
            method: (!__investmentId)? 'post' : 'patch',
            url: (!__investmentId)? 'investments' : 'investments/' + __investmentId,
            data: data
        }).then(function (response) {

            toastr.success('Sikeres mentés');
            setTimeout(() => {
                window.location.reload()
            }, 1500);

        }).catch(function (error) {

            try {
                let errorMsg = '';
                for(let key in error.response.data.errors){
                    errorMsg += '<span>'+error.response.data.errors[key]+'</span>';
                }
                toastr.error(errorMsg);
            } catch (error) {
                toastr.error(error);
            }

        })
    });

    function checkFieldIsNotEmpty(){

        requiredFileds.forEach(field => {
            console.log(field.id)
            if(document.getElementById(field.id).value == ''){
                toastr.error(field.msg, 'Form validációs hiba');
                return false;
            }
        })
        return true;
    }

    document.getElementById('currency').addEventListener('change', () => {

        if(document.getElementById('currency').options[document.getElementById('currency').selectedIndex].value === 'HUF'){
            document.getElementById('exchange-rate-div').value = '';
            document.getElementById('exchange-rate-div').style.display = 'none';
        }else{
            document.getElementById('exchange-rate-div').style.display = 'block';
        }
    });

    /**
     *
     * @param {HtmlElementObject} element Lekéri a szerkeszteni kivánt adatokat
     */
    function editInvestment(element){
        __investmentId = element.getAttribute('data-id');
        axios.get('investments/' + __investmentId, config).then(function(response){

            const investment = response.data;

            document.getElementById('name').value = investment.name;
            document.getElementById('investment-type').value = investment.type_id;

            $('#transaction-date').daterangepicker({
                "singleDatePicker": true,
                "autoUpdateInput": true,
                "autoApply": true,
                "startDate": investment.transaction_date,
                locale: dateSettings,
            });

            document.getElementById('amount').value = investment.amount;
            document.getElementById('currency').value = investment.currency;
            document.getElementById('exchange-rate').value = investment.exchange_rate;
            document.getElementById('quantity').value = investment.quantity;
            document.getElementById('anual-income').value = investment.anual_income;
            document.getElementById('term').value = investment.term;
            document.getElementById('investment-modal-title').innerHTML = '#' + __investmentId + ' modósítása';
            $("#addInvestment").modal();
        });
    }

    /**
     * Ha bezárjuk az új hozzáadása modalt
     */
    $("#addNewMasseurModal").on("hidden.bs.modal", function () {
        __investmentId = false;
        document.getElementById('addInvestment').innerHTML = 'Új befektetés'
        document.getElementById('name').value = '';
        document.getElementById('amount').value = '';
        document.getElementById('exchange-rate').value = '';
        document.getElementById('quantity').value = '';
        document.getElementById('anual-income').value = '';
        document.getElementById('term').value = '';
    });

    addeventForActionMenu();

    /**
     * beállitja az edit delete müveleteket
     */
     function addeventForActionMenu(){

        /**
        * Editre kattintva meghivja az edit modalt
        */
       let investmentEditButton = document.querySelectorAll('a[data-type="edit"]');
       investmentEditButton.forEach(element =>{
           element.addEventListener('click', () => {
               editInvestment(element);
           });
       });

       /**
        * Törlés gombra kattintva
        */
       /*let investmentDeleteButton = document.querySelectorAll('a[data-type="delete"]');
       investmentDeleteButton.forEach(element =>{
           element.addEventListener('click', () => {
               deleteInvestment(element);
           })
       });*/
   }
})
