<?php

use App\Patient;
use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient = new Patient([
            'voornaam' => 'Ellemieke',
            'naam' => 'Dingemans',
            'contact_met_coronavirus' => 1
        ]);
        $patient->save();

        $patient = new Patient([
            'voornaam' => 'Lisanne',
            'naam' => 'Boonstra',
            'contact_met_coronavirus' => 1
        ]);
        $patient->save();

        $patient = new Patient([
            'voornaam' => 'Mirre',
            'naam' => 'Keijzers',
            'contact_met_coronavirus' => 0
        ]);
        $patient->save();

        $patient = new Patient([
            'voornaam' => 'Dineke Jansen',
            'naam' => 'van Martens',
            'contact_met_coronavirus' => 1
        ]);
        $patient->save();

        $patient = new Patient([
            'voornaam' => 'Noud',
            'naam' => 'van Dongen',
            'contact_met_coronavirus' => 0
        ]);
        $patient->save();

        $patient = new Patient([
            'voornaam' => 'Maaike',
            'naam' => 'Schansert',
            'contact_met_coronavirus' => 1
        ]);
        $patient->save();

        $patient = new Patient([
            'voornaam' => 'Gerrit-Jan',
            'naam' => 'Belderman',
            'contact_met_coronavirus' => 1
        ]);
        $patient->save();
    }
}
