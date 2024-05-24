<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserImport implements ToCollection ,ToModel
{
    private $current=0;
    /**
     * @param \Illuminate\Support\Collection $collection
     */
    public function collection(Collection $collection)
    {


    }

    public function model(array $row)
{
    $this->current++;
    if ($this->current > 1) {
        $enseignat = new  User;
        $enseignat->name = $row[0];
        $enseignat->prenom = $row[1];
        $enseignat->email = $row[2];
        $enseignat->password = Hash::make($row[3]);
        $enseignat->grade = $row[4];
        $enseignat->type = $row[5];
        $enseignat->user_type = 2;
        $enseignat->save();
    }
}



























}
