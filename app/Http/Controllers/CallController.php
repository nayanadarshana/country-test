<?php

namespace App\Http\Controllers;

use App\Repositories\CallRepository;
use Illuminate\Http\Request;

class CallController extends Controller
{

    private CallRepository $callRepository;

    public function __construct(CallRepository $callRepository)
    {
        $this->callRepository = $callRepository;
    }

    public function getAllCountries()
    {
        return response()->json($this->callRepository->getAllCountries(), 200);
    }

    public function getSelectedCountry($id)
    {
        return response()->json($this->callRepository->getSelectedCountry($id));
    }

    public function getSelectedState($id)
    {
        return response()->json($this->callRepository->getSelectedState($id));
    }

    public function getSelectedCity($id)
    {
        return response()->json($this->callRepository->getSelectedCity($id));
    }
}
