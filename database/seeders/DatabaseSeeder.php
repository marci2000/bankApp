<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bank;
use App\Models\ExchangeRate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if (User::all()->count() < 20) {
            User::factory(20)->create();
        }

        if (User::where('is_admin', 1)->get()->count() == 0) {
            User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'is_admin' => 1,
                ]);
        }

        if (Bank::all()->count() != 4) {

            ExchangeRate::where('id', '>', 0)->delete();

            Bank::where('id', '>', 0)->delete();

            $bankNames = ['BNR', 'ECB', 'NBP', 'BOC'];
            $abbreviations = ['Banca Nationala Romana', 'European Central Bank', 'Narodowy Bank Polski', 'Bank Of Canada'];

            collect()->range(0, count($bankNames) - 1)->map(function($id) use ($bankNames, $abbreviations) {
                Bank::create([
                    'id' => $id,
                    'name' => $bankNames[$id],
                    'abbreviation' => $abbreviations[$id],
                    'updated' => Carbon::now(),
                    'is_active' => 1
                ]);
            });
        }
    }
}
