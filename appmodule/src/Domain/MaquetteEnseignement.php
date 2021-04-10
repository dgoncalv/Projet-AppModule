<?php

namespace App\Domain;

interface MaquetteEnseignement
{
    public function findUEsOfASemester(string $semester): iterable;
    public function findModulesOfASemester(string $semester): iterable;
}
