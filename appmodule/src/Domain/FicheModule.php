<?php

namespace App\Domain;

interface FicheModule
{
    public function findTeachersOfAModule($module): iterable;
}
