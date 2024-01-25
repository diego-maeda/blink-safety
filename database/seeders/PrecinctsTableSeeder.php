<?php

namespace Database\Seeders;

use App\Models\Precinct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrecinctsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Precinct::updateOrcreate([
            'precinct' => '33705',
        ],
        [
            'city' => 'st petersburg',
            'state' => 'fl',
            'link' => 'https://stat.stpete.org/Government/St-Petersburg-Police-Department-Calls-for-Service-/6nse-tdf4'
        ]);

        Precinct::updateOrcreate([
            'precinct' => '32803',
        ],
            [
                'city' => 'orlando',
                'state' => 'fl',
                'link' => 'https://www1.cityoforlando.net/opd/activecalls/activecadpolice.xml'
            ]);

    }
}
