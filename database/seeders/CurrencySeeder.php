<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name'               => 'Taka',
            'code'               => Str::upper('TK'),
            'symbol'             => 'TK',
            'thousand_separator' => ',',
            'decimal_separator'  => '.',
            'exchange_rate'      => null,
        ]);
    }
}
