<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_records_infos', function (Blueprint $table) {
            $table->id();
            $table->string('health-date')->nullable()->comment('日期');
            $table->string('health-breakfast')->nullable()->comment('早餐');
            $table->string('health-breakfast-img')->nullable()->comment('早餐照');
            $table->string('health-lunch')->nullable()->comment('午餐');
            $table->string('health-lunch-img')->nullable()->comment('午餐照');
            $table->string('health-dinner')->nullable()->comment('晚餐');
            $table->string('health-dinner-img')->nullable()->comment('晚餐照');
            $table->string('health-bedtime-snacks')->nullable()->comment('宵夜');
            $table->string('health-bedtime-snacks-img')->nullable()->comment('宵夜照');
            $table->string('health-snacks')->nullable()->comment('零食');
            $table->string('health-drinks')->nullable()->comment('飲料');
            $table->string('health-water')->nullable()->comment('喝水量');
            $table->string('health-sports')->nullable()->comment('有無運動');
            $table->string('health-defecation-count')->nullable()->comment('排便次數');
            $table->string('health-getup-time')->nullable()->comment('起床時間');
            $table->string('health-sleep-time')->nullable()->comment('睡眠時間');
            $table->longText('health-mood-sharing')->nullable()->comment('心情分享');
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
        Schema::dropIfExists('health_records_infos');
    }
};
