<?php

namespace App\Repositories;

use App\Interfaces\CallInterface;
use App\Models\City;
use App\Models\Country;
use App\Models\States;

class CallRepository implements CallInterface
{

    public function getAllCountries()
    {

        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $countries = Country::withCount(['states', 'states as total_cities' => function ($query) {
            $query->join('cities', 'states.id', '=', 'cities.states_id')
                ->selectRaw('count(distinct cities.id)');
        }])
            ->with(['states' => function ($query) {
                $query->with(['cities' => function ($query) {
                    $query->with(['clients' => function ($query) {
                        $query->select('clients.id', 'clients.city_id','clients.company');
                    }])->select('cities.id', 'cities.states_id', 'cities.city');
                    $query->join('states', 'cities.states_id', '=', 'states.id');
                    $query->join('countries', 'states.country_id', '=', 'countries.id');
                    $query->paginate(10);
                }])->select('states.id', 'states.country_id', 'states.state');
            }])
            ->paginate(10);


        return response()->json($countries);
    }

    public function getSelectedCountry($id)
    {

        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $country = Country::withCount(['states', 'states as total_cities' => function ($query) {
            $query->join('cities', 'states.id', '=', 'cities.states_id')
                ->selectRaw('count(distinct cities.id)');
        }])
            ->with(['states' => function ($query) {
                $query->with(['cities' => function ($query) {
                    $query->with(['clients' => function ($query) {
                        $query->with(['calls' => function ($query) {
                            $query->select('calls.id', 'calls.client_id');
                        }])->select('clients.id', 'clients.city_id','clients.company');
                    }])->select('cities.id', 'cities.states_id', 'cities.city');
                    $query->join('states', 'cities.states_id', '=', 'states.id');
                    $query->join('countries', 'states.country_id', '=', 'countries.id');
                    $query->paginate(10);
                }])->select('states.id', 'states.country_id', 'states.state');
            }])
            ->find($id);

        if (!$country) {

            return response()->json(['error' => 'Country not found'], 404);
        }

        return response()->json($country);
    }

    public function getSelectedState($id)
    {
        $state = States::withCount(['cities'])
            ->with(['cities.clients' => function ($query) {
                $query->select('id', 'company', 'city_id')
                    ->with(['city:id,city,states_id', 'city.state:id,state,country_id']);
            }])
            ->find($id);

        if (!$state) {

            return response()->json(['error' => 'State not found'], 404);
        }

        return response()->json($state);

    }

    public function getSelectedCity($id)
    {
        $city = City::with(['clients' => function ($query) {
            $query->with(['city:id,city,states_id', 'city.state:id,state,country_id', 'calls']);
        }])
            ->find($id);

        if (!$city) {

            return response()->json(['error' => 'City not found'], 404);
        }

        return response()->json($city);
    }
}
