<?php

use App\Afspraak;
use Illuminate\Database\Seeder;

class AfspraakTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $afspraak = new Afspraak([
            'datum' => '2020-08-18',
            'tijdstip' => '19:59',
            'patient_id' => 6
        ]);
        $afspraak->save();

        $afspraak = new Afspraak([
            'datum' => '2020-10-02',
            'tijdstip' => '13:25',
            'patient_id' => 2
        ]);
        $afspraak->save();

        $afspraak = new Afspraak([
            'datum' => '2020-10-28',
            'tijdstip' => '14:35',
            'patient_id' => 7
        ]);
        $afspraak->save();

        $afspraak = new Afspraak([
            'datum' => '2020-11-17',
            'tijdstip' => '14:50',
            'patient_id' => 3
        ]);
        $afspraak->save();

        $afspraak = new Afspraak([
            'datum' => '2020-11-27',
            'tijdstip' => '16:55',
            'patient_id' => 1
        ]);
        $afspraak->save();

        $afspraak = new Afspraak([
            'datum' => '2020-10-20',
            'tijdstip' => '10:45',
            'patient_id' => 5
        ]);
        $afspraak->save();

        $afspraak = new Afspraak([
            'datum' => '2020-10-26',
            'tijdstip' => '11:15',
            'patient_id' => 3
        ]);
        $afspraak->save();

        $afspraak = new Afspraak([
            'datum' => '2020-10-27',
            'tijdstip' => '12:25',
            'patient_id' => 4
        ]);
        $afspraak->save();

        $afspraak = new Afspraak([
            'datum' => '2020-11-19',
            'tijdstip' => '14:55',
            'patient_id' => 6
        ]);
        $afspraak->save();

        $afspraak = new Afspraak([
            'datum' => '2020-12-08',
            'tijdstip' => '16:00',
            'patient_id' => 6
        ]);
        $afspraak->save();
    }
}
