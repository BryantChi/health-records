<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecordsInfo extends Model
{
    use HasFactory;

    protected $table = 'health_records_infos';

    protected $fillable = [
        'health-date',
        'health-breakfast',
        'health-breakfast-img',
        'health-lunch',
        'health-lunch-img',
        'health-dinner',
        'health-dinner-img',
        'health-bedtime-snacks',
        'health-bedtime-snacks-img',
        'health-snacks',
        'health-drinks',
        'health-water',
        'health-sports',
        'health-defecation-count',
        'health-getup-time',
        'health-sleep-time',
        'health-mood-sharing',
    ];

    protected $cast = [
        'health-breakfast-img' => 'json',
        'health-lunch-img' => 'json',
        'health-dinner-img' => 'json',
        'health-bedtime-snacks-img' => 'json',
    ];

    public static $rules = [];

    public static $messages = [];
}
