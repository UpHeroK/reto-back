<?php

namespace Database\Seeders;

use App\Models\Contract;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $contrato = new Contract();
        $contrato->tipo="ops";
        $contrato->save();

        $contrato1 = new Contract();
        $contrato1->tipo="labor";
        $contrato1->save();

        $contrato2 = new Contract();
        $contrato2->tipo="término fijo";
        $contrato2->save();

        $contrato3 = new Contract();
        $contrato3->tipo="término indefinido";
        $contrato3->save();

        $contrato4 = new Contract();
        $contrato4->tipo="aprendizaje";
        $contrato4->save();

        $contrato5 = new Contract();
        $contrato5->tipo="ocasional";
        $contrato5->save();
    }
}
