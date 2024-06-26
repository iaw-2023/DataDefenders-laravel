<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up():void{
		Schema::create('scholarship_offer_major', function (Blueprint $table){
			$table->foreignId('scholarship_offer_id')->references('id')->on('scholarship_offers')->restrictOnDelete()->cascadeOnUpdate();
			$table->foreignId('major_id')->references('id')->on('majors')->restrictOnDelete()->cascadeOnUpdate();
			$table->unique(['scholarship_offer_id', 'major_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down():void{
		Schema::dropIfExists('scholarship_offer_major');
	}

};
