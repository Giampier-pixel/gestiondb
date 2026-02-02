<?php

namespace App\Imports;
use app\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class UsuariosImport implements ToModel, withHeadingRow
{
    
    public function model(array $row)
    {
        DB::transaction(function () use ($row){
            User::create([
                'dni'=>$row ['dni'],
                'paternal_surname'=>$row['paternal_surname'],
                'maternal_surname'=>$row['maternal_surname'],
                'name'=>$row['nombres'],
                'email'=>$row['dni']."@fis.edu",
                'password'=>bcrypt ('secreto')
            ]);
        });
    }
}
