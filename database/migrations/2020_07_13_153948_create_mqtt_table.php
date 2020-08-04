<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateMqttTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mqtt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('ts')->default('CURRENT_TIMESTAMP');
            $table->text('topic')->nullable()->default(null);
            $table->longText('value')->nullable()->default(null);
            $table->integer('qos')->nullable()->default(null);
            $table->integer('retain')->nullable()->default(null);
            $table->tinyInteger('history_enable')->nullable()->default(null);
            $table->tinyInteger('history_diffonly')->nullable()->default(null);
        });
        Schema::create('mqtt_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('ts')->default('CURRENT_TIMESTAMP');
            $table->integer('topicid')->nullable()->default(null);
            $table->longText('value')->nullable()->default(null);
        });
        DB::statement("
        CREATE VIEW mqtt_history_view 
        AS
        SELECT
        h.id,
        h.ts AS 'ts',
        m.ts AS 'ts_last',
        m.topic,
        h.value
        FROM mqtt_history h
        INNER JOIN mqtt m
            ON m.id = h.topicid
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mqtt_history');
        Schema::dropIfExists('mqtt');
    }
}
