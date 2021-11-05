<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Problem;

class ProblemController extends Controller
{
    public function all()
    {
        $problems = Problem::all();

        return response()->json(['data' => $problems], 200);
    }

    public function create(Request $request)
    {
        $problem = new Problem();
        $problem->product_id = $request->product_id;
        $problem->device_id = $request->device_id;
        $problem->problem_datetime = $request->problem_datetime;
        $problem->latitude = $request->latitude;
        $problem->longitude = $request->longitude;

        $problem->problem_detail = $request->problem_detail;
        $problem->id_employee = $request->id_employee;
        $problem->repair_detail = $request->repair_detail;
        $problem->repair_datetime = $request->repair_datetime;
        $problem->status = $request->status;
        $problem->remark = $request->remark;
        $problem->del_flg = $request->del_flg;
        $problem->created_id = $request->created_id;
        $problem->updated_id = $request->updated_id;
        $problem->save();

        return response()->json(['status' => 'OK'], 201);
    }
}