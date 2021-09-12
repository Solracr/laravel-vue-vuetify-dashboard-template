<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamentos =[

            [ 'codigo' =>'1', 'nombre' => 'Guatemala'],
            [ 'codigo' =>'2', 'nombre' => 'El Progreso'],
            [ 'codigo' =>'3', 'nombre' => 'Sacatepéquez'],
            [ 'codigo' =>'4', 'nombre' => 'Chimaltenango'],
            [ 'codigo' =>'5', 'nombre' => 'Escuintla'],
            [ 'codigo' =>'6', 'nombre' => 'Santa Rosa'],
            [ 'codigo' =>'7', 'nombre' => 'Sololá'],
            [ 'codigo' =>'8', 'nombre' => 'Totonicapán'],
            [ 'codigo' =>'9', 'nombre' => 'Quetzaltenango'],
            [ 'codigo' =>'10', 'nombre' => 'Suchitepéquez'],
            [ 'codigo' =>'11', 'nombre' => 'Retalhuleu'],
            [ 'codigo' =>'12', 'nombre' => 'San Marcos'],
            [ 'codigo' =>'13', 'nombre' => 'Huehuetenango'],
            [ 'codigo' =>'14', 'nombre' => 'Quiché'],
            [ 'codigo' =>'15', 'nombre' => 'Baja Verapaz'],
            [ 'codigo' =>'16', 'nombre' => 'Alta Verapaz'],
            [ 'codigo' =>'17', 'nombre' => 'Petén'],
            [ 'codigo' =>'18', 'nombre' => 'Izabal'],
            [ 'codigo' =>'19', 'nombre' => 'Zacapa'],
            [ 'codigo' =>'20', 'nombre' => 'Chiquimula'],
            [ 'codigo' =>'21', 'nombre' => 'Jalapa'],
            [ 'codigo' =>'22', 'nombre' => 'Jutiapa'],
        ];
        foreach ($departamentos as $departamento){
            Departamento::create($departamento);
        }
    }
}
