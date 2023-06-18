<?php

namespace App\Interfaces;
interface CallInterface
{
    public function getAllCountries();

    public function getSelectedCountry($id);

    public function getSelectedState($id);
    public function getSelectedCity($id);

}
