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

            $table->integer('type_id')->unsigned();
            $table->index('type_id');
            $table->foreign('type_id')->references('id')->on('investment_types');

            $table->date('transaction_date')->comment('Tranzakció dátuma');
            $table->integer('amount')->comment('Befektetés összege');
            $table->string('currency', 3)->comment('A befektetés devizája: HUF, EUR, USD');
            $table->integer('exchange_rate', 3)->nullable()->comment('Tranzakció dátumán érvényes árfolyam, kötelező megadni ha nem forintban történt a befektetés');
            $table->decimal('quantity', 15, 8)->comment('A befektetett összegért cserébe milyen mennyiségre tett szert az adott típusú befektetésből (8 tizedesjegyig megadható tört szám is)');
            $table->decimal('anual_income', 5, 2)->comment('Százalékban megadott várható hozam (2 tizedesjegyig megadható tört szám is)');
            $table->integer('term', 3)->nullable()->comment('Hónapok száma, a befektetés tervezett hossza / futamideje');
            $table->timestamps();
        });
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
