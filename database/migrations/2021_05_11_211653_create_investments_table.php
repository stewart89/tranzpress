<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {

            $table->id();
            $table->string('name', 1023);

            $table->bigInteger('type_id')->unsigned();
            $table->index('type_id');
            $table->foreign('type_id')->references('id')->on('investment_types');

            $table->date('transaction_date')->comment('Tranzakció dátuma');
            $table->integer('amount')->unsigned()->comment('Befektetés összege');
            $table->string('currency', 3)->comment('A befektetés devizája: HUF, EUR, USD');
            $table->integer('exchange_rate')->nullable()->comment('Tranzakció dátumán érvényes árfolyam, kötelező megadni ha nem forintban történt a befektetés');
            $table->decimal('quantity', 15, 8)->comment('A befektetett összegért cserébe milyen mennyiségre tett szert az adott típusú befektetésből (8 tizedesjegyig megadható tört szám is)');
            $table->decimal('anual_income', 5, 2)->comment('Százalékban megadott várható hozam (2 tizedesjegyig megadható tört szám is)');
            $table->integer('term')->unsigned()->nullable()->comment('Hónapok száma, a befektetés tervezett hossza / futamideje');
            $table->timestamps();
        });

        //Add the mysql function

        DB::unprepared('CREATE FUNCTION calculate_income(per INT, transaction_date DATE, amount INT, currency VARCHAR(3), exchange_rate INT, anual_income FLOAT) RETURNS int DETERMINISTIC
                BEGIN
                    DECLARE end_date DATE;
                    DECLARE last_year_plus_days INT;
                    DECLARE last_year_income_percentage FLOAT;
                    DECLARE result INT;
                    DECLARE anual_income_amount FLOAT;

                    #Beállitjuk az végső dátumot
                    SET end_date = DATE_ADD(transaction_date, INTERVAL per YEAR);

                    #Kiszámoljuk év végéig levő napok számát
                    SET last_year_plus_days = ABS(DATEDIFF(end_date, (DATE_FORMAT(end_date, "%Y-12-31"))));

                    #Kiszámoljuk a hozamot az utolsó évben év végéig
                    SET last_year_income_percentage = (last_year_plus_days / DAYOFYEAR(DATE_FORMAT(end_date, "%Y-12-31")));

                    #Ha nem forint
                    IF currency != "HUF" THEN
                        SET amount = amount * exchange_rate;
                    END IF;

                    #Kiszámoljuk az 1 évnyi hozamot
                    SET anual_income_amount = (amount * anual_income / 100);

                    #Kiszámoljuk az eredményt
                    SET result = (anual_income_amount * per) + anual_income_amount * last_year_income_percentage;

                    RETURN result;
                END'
            );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investments', function (Blueprint $table) {

            $table->dropForeign('type_id');
            $table->dropIndex('type_id');
        });
        Schema::dropIfExists('investments');
    }
}
