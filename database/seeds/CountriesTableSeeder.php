<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countriesFromJson = file_get_contents(public_path().'/assets/js/countries.json');
        $countries = json_decode($countriesFromJson);
        $myCountries = [];

        foreach ($countries as $c) {
            $myCountries[] = [
                'name' => $c->country,
                'phone' => $c->calling_code,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        DB::table('countries')->insert($myCountries);
    }
}
