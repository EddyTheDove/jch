<?php

use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = [
            [
                'name'      => 'Basic Report',
                'slug'      => 'basic',
                'amount'    => 4000
            ], [
                'name'      => 'Intermediate Report',
                'slug'      => 'intermediate',
                'amount'    => 8500
            ], [
                'name'      => 'Full Report',
                'slug'      => 'full',
                'amount'    => 11000
            ], [
                'name'      => 'Australian PPSR',
                'slug'      => 'ppsr',
                'amount'    => 900
            ]
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }

    }
}
