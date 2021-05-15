<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_types', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->string('name', 31)->comment('Befektetés típusa: Állampapír, Részvény, Kötvény, Valuta, Deviza, Ingatlan, Kriptotőzsde, Egyéb');
            $table->timestamps();
        });

        // Insert default values
        DB::table('investment_types')->insert([
            ['name' => 'Állampapír'],
            ['name' => 'Részvény'],
            ['name' => 'Kötvény'],
            ['name' => 'Valuta'],
            ['name' => 'Deviza'],
            ['name' => 'Ingatlan'],
            ['name' => 'Kriptotőzsde'],
            ['name' => 'Egyéb'],
        ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investment_types');
    }
}
