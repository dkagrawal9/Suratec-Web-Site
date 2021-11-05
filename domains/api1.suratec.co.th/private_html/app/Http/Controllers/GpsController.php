<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Gps;


class GpsController extends Controller
{
    public function all()
    {
        $gps = Gps::limit(10)->get();
        return response()->json(['data' => $gps], 200);
    }

    public function addMultiple(Request $request)
    {
        Gps::truncate();

        $gpsData = $request->gpsData;
        // $gpsAll = array();
        foreach ($gpsData as $row) {
            // fake data
            // $gps = new Gps();
            // $gps->device_id = 'd-1';
            // $gps->latitude = '11.029322';
            // $gps->longitude = '102.203922';
            // $gps->altitude = 1;
            // $gps->speed = 90;
            // $gps->carno = 'CN-1';
            // $gps->hospname = 'H-' . str_random(5);
            // $gps->direction = rand(1, 12);
            // $gps->alarm = 'al-' . rand(100, 999);
            // $gps->msg = str_random(10);
            // $gps->temperature = '1.00';
            // $gps->fuel = '50.00';
            // $gps->accontime = 'test';
            // $gps->accofftime = 'test';
            // $gps->action_datetime = date('Y-m-d H:i:s');
            // $gps->save();

            $gps = new Gps();
            $gps->device_id = $row['deviceid'];
            $gps->latitude = $row['lat'];
            $gps->longitude = $row['lot'];
            $gps->altitude = $row['altitude'];
            $gps->speed = $row['speed'];
            $gps->carno = $row['carno'];
            // $gps->hospname = $request->hospname;
            $gps->direction = $row['direction'];
            $gps->alarm = $row['alarm'];
            $gps->msg = $row['msg'];
            $gps->temperature = (string) $row['temperature'];
            $gps->fuel = (string) $row['fuel'];
            $gps->accontime = $row['accontime'];
            $gps->accofftime = $row['accofftime'];
            $gps->action_datetime = date('Y-m-d H:i:s');

            // array_push($gpsAll, $gps);
            // $gps->save();
        }

        // return response()->json(['data' => $gpsAll], 201);
        return response()->json(['message' => 'OK'], 201);
    }


    public function gps_history(Request $request)
    {
        $fromDate = date($request['date_start']);
        $toDate = date($request['to_date']);

        $gps = Gps::where('carno', $request['carno'])
            ->whereBetween('action_datetime', [$fromDate, $toDate])
            ->groupBy('latitude')
            ->get();

        return response()->json([
            'status' => 'OK',
            'data' => $gps,
        ], 200);
    }
}