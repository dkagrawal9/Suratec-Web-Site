<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Member;
use App\Customer;
use App\Employee;
use App\Daily_data;
use App\Surasole;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Exception;

class SurasoleController extends Controller
{

    public function getRecordData(Request $request)
    {
        if (Customer::where('id_customer', $request->customer)->exists()) {
            $data = Surasole::where('id_customer', $request->customer)->whereDate('action', date("Y-m-d"))->get();
            $count = 0;
            $action = 0;
            $left_sensor = [];
            $right_sensor = [];
            $retData = [];
            for ($i = 0; $i < count($data); $i++) {
                if ($i != 0) {
                    if ($data[$i]->duration - $data[$i - 1]->duration >= 0) {
                        $lsensor = [$data[$i]->left_sensor1, $data[$i]->left_sensor2, $data[$i]->left_sensor3, $data[$i]->left_sensor4, $data[$i]->left_sensor5];
                        $rsensor = [$data[$i]->right_sensor1, $data[$i]->right_sensor2, $data[$i]->right_sensor3, $data[$i]->right_sensor4, $data[$i]->right_sensor5];
                        array_push($left_sensor, $lsensor);
                        array_push($right_sensor, $rsensor);
                    } else {
                        $retData[$count]['action'] = $data[$action]->action;
                        $retData[$count]['duration'] = $data[$i - 1]->duration;
                        $retData[$count]['left'] = $left_sensor;
                        $retData[$count]['right'] = $right_sensor;
                        $left_sensor = [];
                        $right_sensor = [];
                        $action = $i + 1;
                        $count++;
                    }
                } else {
                    $lsensor = [$data[$i]->left_sensor1, $data[$i]->left_sensor2, $data[$i]->left_sensor3, $data[$i]->left_sensor4, $data[$i]->left_sensor5];
                    $rsensor = [$data[$i]->right_sensor1, $data[$i]->right_sensor2, $data[$i]->right_sensor3, $data[$i]->right_sensor4, $data[$i]->right_sensor5];
                    array_push($left_sensor, $lsensor);
                    array_push($right_sensor, $rsensor);
                }
            }
            if ($count >= 0) {
                $retData[$count]['action'] = $data[$action]->action;
                $retData[$count]['duration'] = $data[count($data) - 1]->duration;
                $retData[$count]['left'] = $left_sensor;
                $retData[$count]['right'] = $right_sensor;
            }
            return $retData;
        } else {
            return $this->responseRequestError();
        }
    }

    public function getProfilePath(Request $request)
    {
        $path = Customer::where('id_customer', $request->customer)->first();
        return $this->responseRequestSuccess($path->img_path);
    }

    public function getProfilePicture(Request $request)
    {
        try {
            $path = './pic' . $request->route('path');
            return response()->download($path);
        } catch (Exception $e) {
            return $this->responseRequestError();
        }
    }

    protected function getRandomName()
    {
        $str = '';
        for ($i = 0; $i < 16; $i++) {
            $mode = mt_rand(0, 2);
            if ($mode == 0) {
                $str = $str . chr(mt_rand(48, 57));
            } else if ($mode == 1) {
                $str = $str . chr(mt_rand(65, 90));
            } else {
                $str = $str . chr(mt_rand(97, 112));
            }
        }
        return $str;
    }

    public function upDateProfile(Request $request)
    {
        if ($request->type == 'mod_customer') {
        $user = Customer::findOrFail($request->id);
        if ($user) {
            if ($request->hasFile('image')) {
                $original_filename = $request->file('image')->getClientOriginalName();
                $original_filename_arr = explode('.', $original_filename);
                $file_ext = end($original_filename_arr);
                $destination_path = './pic';
                $image = 'SS-' . $this->getRandomName() . '.' . $file_ext;
                while (Customer::where('img_path', $image)->exists()) {
                    $image = 'SS-' . $this->getRandomName() . '.' . $file_ext;
                }
                if ($request->file('image')->move($destination_path, $image)) {
                    $user->img_path = $image;
                    $user->save();
                    return $this->responseRequestSuccess($user->img_path);
                } else {
                    return $this->responseRequestError('Cannot upload file');
                }
            } else {
                return $this->responseRequestError('Cannot upload file');
            }
        } else {
            return $this->responseRequestError();
        }
     } else{
            $user = Employee::findOrFail($request->id);
            if ($user) {
                if ($request->hasFile('image')) {
                    $original_filename = $request->file('image')->getClientOriginalName();
                    $original_filename_arr = explode('.', $original_filename);
                    $file_ext = end($original_filename_arr);
                    $destination_path = './pic';
                    $image = 'SS-' . $this->getRandomName() . '.' . $file_ext;
                    while (Customer::where('img_path', $image)->exists()) {
                        $image = 'SS-' . $this->getRandomName() . '.' . $file_ext;
                    }
                    if ($request->file('image')->move($destination_path, $image)) {
                        $user->img_path = $image;
                        $user->save();
                        return $this->responseRequestSuccess($user->img_path);
                    } else {
                        return $this->responseRequestError('Cannot upload file');
                    }
                } else {
                    return $this->responseRequestError('Cannot upload file');
                }
            } else {
                return $this->responseRequestError();
            }
        }
    }

    public function updatesurasolepressure(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        $left_peak_pressure_position = trim($request->left_peak_pressure_position);
        $left_peak_pressure_value = trim($request->left_peak_pressure_value);
        $right_peak_pressure_position = trim($request->right_peak_pressure_position);
        $right_peak_pressure_value = trim($request->right_peak_pressure_value);
        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();

            $surasole->left_peak_pressure_position = $left_peak_pressure_position;
            $surasole->left_peak_pressure_value = $left_peak_pressure_value;
            $surasole->right_peak_pressure_position = $right_peak_pressure_position;
            $surasole->right_peak_pressure_value = $right_peak_pressure_value;

            $surasole->save();
            return response()->json(['status' => 'บันทึกข้อมูลสำเร็จ', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function selectsurasolepressure(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();
            return response()->json(['status' => 'แสดงข้อมูล', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function updatesurasolebalance(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        $left_balance_x = trim($request->left_balance_x);
        $left_balance_y = trim($request->left_balance_y);
        $right_balance_x = trim($request->right_balance_x);
        $right_balance_y = trim($request->right_balance_y);
        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();

            $surasole->left_balance_x = $left_balance_x;
            $surasole->left_balance_y = $left_balance_y;
            $surasole->right_balance_x = $right_balance_x;
            $surasole->right_balance_y = $right_balance_y;

            $surasole->save();
            return response()->json(['status' => 'บันทึกข้อมูลสำเร็จ', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function selectsurasolebalance(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();
            return response()->json(['status' => 'แสดงข้อมูล', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function updatesurasolesensor(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        $left_sensor1 = trim($request->left_sensor1);
        $left_sensor2 = trim($request->left_sensor2);
        $left_sensor3 = trim($request->left_sensor3);
        $left_sensor4 = trim($request->left_sensor4);
        $left_sensor5 = trim($request->left_sensor5);
        $right_sensor1 = trim($request->right_sensor1);
        $right_sensor2 = trim($request->right_sensor2);
        $right_sensor3 = trim($request->right_sensor3);
        $right_sensor4 = trim($request->right_sensor4);
        $right_sensor5 = trim($request->right_sensor5);
        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();

            $surasole->left_sensor1 = $left_sensor1;
            $surasole->left_sensor2 = $left_sensor2;
            $surasole->left_sensor3 = $left_sensor3;
            $surasole->left_sensor4 = $left_sensor4;
            $surasole->left_sensor5 = $left_sensor5;

            $surasole->right_sensor1 = $right_sensor1;
            $surasole->right_sensor2 = $right_sensor2;
            $surasole->right_sensor3 = $right_sensor3;
            $surasole->right_sensor4 = $right_sensor4;
            $surasole->right_sensor5 = $right_sensor5;

            $surasole->save();
            return response()->json(['status' => 'บันทึกข้อมูลสำเร็จ', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function selectsurasolesensor(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();
            return response()->json(['status' => 'แสดงข้อมูล', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function updatesurasoleleftstride(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        $left_stride_F = trim($request->left_stride_F);
        $left_stride_M = trim($request->left_stride_M);
        $left_stride_H = trim($request->left_stride_H);

        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();

            $surasole->left_stride_F = $left_stride_F;
            $surasole->left_stride_M = $left_stride_M;
            $surasole->left_stride_H = $left_stride_H;

            $surasole->save();
            return response()->json(['status' => 'บันทึกข้อมูลสำเร็จ', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function selectsurasoleleftstride(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();
            return response()->json(['status' => 'แสดงข้อมูล', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function updatesurasolerightstride(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        $right_stride_F = trim($request->right_stride_F);
        $right_stride_M = trim($request->right_stride_M);
        $right_stride_H = trim($request->right_stride_H);

        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();

            $surasole->right_stride_F = $right_stride_F;
            $surasole->right_stride_M = $right_stride_M;
            $surasole->right_stride_H = $right_stride_H;

            $surasole->save();
            return response()->json(['status' => 'บันทึกข้อมูลสำเร็จ', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function selectsurasolerightstride(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();
            return response()->json(['status' => 'แสดงข้อมูล', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function updatesurasoleswing(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        $left_swing_phase = trim($request->left_swing_phase);
        $left_stance_phase = trim($request->left_stance_phase);
        $right_swing_phase = trim($request->right_swing_phase);
        $right_stance_phase = trim($request->right_stance_phase);
        $body_COP = trim($request->body_COP);

        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();

            $surasole->left_swing_phase = $left_swing_phase;
            $surasole->left_stance_phase = $left_stance_phase;
            $surasole->right_swing_phase = $right_swing_phase;
            $surasole->right_stance_phase = $right_stance_phase;
            $surasole->body_COP = $body_COP;

            $surasole->save();
            return response()->json(['status' => 'บันทึกข้อมูลสำเร็จ', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function selectsurasoleswing(Request $request)
    {
        $customer = Customer::where('id_customer', $request->id_customer)->first();
        if ($customer) {
            $surasole = Surasole::where('id_customer', $customer->id_customer)->first();
            return response()->json(['status' => 'แสดงข้อมูล', 'surasole_info' => $surasole,], 200);
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    public function getDataFromJson(Request $request)
    {
        $req = json_decode($request->getContent(), true);
        $customer = Customer::where('id_customer', $req['id_customer'])->first();
        DB::beginTransaction();
        if ($customer) {
            try {
                for ($i = 0; $i < count($req['data']); $i++) {
                    $res = new Surasole();
                    $dataLeft = $this->getDataSide($req, 'left', $i);
                    $strideLeft = $this->getStride($req['data'][$i]['left']['sensor'], 'left');
                    $balanceLeft = $this->getBalance($req['data'][$i]['left']['sensor'], 'left');
                    $dataRight = $this->getDataSide($req, 'right', $i);
                    $strideRight = $this->getStride($req['data'][$i]['right']['sensor'], 'right');
                    $balanceRight = $this->getBalance($req['data'][$i]['right']['sensor'], 'right');
                    $side = 'left';
                    $res[$side . '_sensor1'] = $dataLeft[$side . '_sensor1'];
                    $res[$side . '_sensor2'] = $dataLeft[$side . '_sensor2'];
                    $res[$side . '_sensor3'] = $dataLeft[$side . '_sensor3'];
                    $res[$side . '_sensor4'] = $dataLeft[$side . '_sensor4'];
                    $res[$side . '_sensor5'] = $dataLeft[$side . '_sensor5'];
                    $res[$side . '_stride_F'] = $strideLeft[$side . '_stride_F'];
                    $res[$side . '_stride_M'] = $strideLeft[$side . '_stride_M'];
                    $res[$side . '_stride_H'] = $strideLeft[$side . '_stride_H'];
                    $res[$side . '_balance_x'] = $balanceLeft[$side . '_balance_x'];
                    $res[$side . '_balance_y'] = $balanceLeft[$side . '_balance_y'];
                    $res[$side . '_peak_pressure_position'] = $dataLeft[$side . '_peak_pressure_position'];
                    $res[$side . '_peak_pressure_value'] = $dataLeft[$side . '_peak_pressure_value'];
                    $res[$side . '_swing_phase'] = $dataLeft[$side . '_swing_phase'];
                    $res[$side . '_stance_phase'] = $dataLeft[$side . '_stance_phase'];
                    $side = 'right';
                    $res[$side . '_sensor1'] = $dataRight[$side . '_sensor1'];
                    $res[$side . '_sensor2'] = $dataRight[$side . '_sensor2'];
                    $res[$side . '_sensor3'] = $dataRight[$side . '_sensor3'];
                    $res[$side . '_sensor4'] = $dataRight[$side . '_sensor4'];
                    $res[$side . '_sensor5'] = $dataRight[$side . '_sensor5'];
                    $res[$side . '_stride_F'] = $strideRight[$side . '_stride_F'];
                    $res[$side . '_stride_M'] = $strideRight[$side . '_stride_M'];
                    $res[$side . '_stride_H'] = $strideRight[$side . '_stride_H'];
                    $res[$side . '_balance_x'] = $balanceRight[$side . '_balance_x'];
                    $res[$side . '_balance_y'] = $balanceRight[$side . '_balance_y'];
                    $res[$side . '_peak_pressure_position'] = $dataRight[$side . '_peak_pressure_position'];
                    $res[$side . '_peak_pressure_value'] = $dataRight[$side . '_peak_pressure_value'];
                    $res[$side . '_swing_phase'] = $dataRight[$side . '_swing_phase'];
                    $res[$side . '_stance_phase'] = $dataRight[$side . '_stance_phase'];
                    $cop = $this->getCOP(
                        $res['left_balance_x'],
                        $res['left_balance_y'],
                        $res['right_balance_x'],
                        $res['right_balance_y']
                    );
                    $res['body_COP_x'] = $cop['body_COP_x'];
                    $res['body_COP_y'] = $cop['body_COP_y'];
                    $res['duration'] = $req['data'][$i]['duration'];
                    $res['action'] = $req['data'][$i]['timestamp'];
                    $res['id_customer'] = $req['id_customer'];
                    $res['id_device'] = $req['id_device'];
                    $res['type'] = $req['type'];
                    $res->save();
                }
                DB::commit();
                return $this->responseRequestSuccess('สำเร็จ');
            } catch (Exception $e) {
                DB::rollBack();
                return $this->responseRequestError($e->getMessage());
            }
        } else {
            return $this->responseRequestError("ไม่พบข้อมูล");
        }
    }

    protected function getMax($value)
    {
        $index = 0;
        $max = $value[$index];
        for ($i = 1; $i < \count($value); $i++) {
            if ($value[$i] > $max) {
                $max = $value[$i];
                $index = $i;
            }
        }
        $ret['index'] = $index;
        $ret['max'] = $max;
        return $ret;
    }

    protected function getStride($value, $side)
    {
        $weightF = $value[0] + $value[1] + $value[2];
        $weightM = $value[3];
        $weightH = $value[4];
        $sumWeight = $weightF + $weightH + $weightM;
        if ($sumWeight == 0) {
            $sumWeight = 1;
        }
        $stride[$side . '_stride_F'] = ($weightF / $sumWeight) * 100;
        $stride[$side . '_stride_H'] = ($weightH / $sumWeight) * 100;
        $stride[$side . '_stride_M'] = ($weightM / $sumWeight) * 100;
        return $stride;
    }

    protected function getBalance($value, $side)
    {
        $balance[$side . '_balance_x'] = (($value[0] + $value[1] + $value[2]) / 3) - $value[4];
        $balance[$side . '_balance_y'] = $value[2] - $value[1];
        return $balance;
    }

    protected function getCOP($leftX, $leftY, $rightX, $rightY)
    {
        $cop['body_COP_x'] = $rightX - $rightY;
        $cop['body_COP_y'] = $leftX - $leftY;
        return $cop;
    }

    protected function getDataSide($req, $side, $index)
    {
        $max = 0;
        $maxIndex = 0;
        for ($i = 0; $i < count($req['data'][$index][$side]['sensor']); $i++) {
            $value = $req['data'][$index][$side]['sensor'][$i];
            if ($value > $max) {
                $max = $value;
                $maxIndex = $i;
            }
            $res[$side . '_sensor' . ($i + 1)] = $value;
        }
        $sensor = $req['data'][$index][$side]['sensor'];
        $res[$side . '_peak_pressure_position'] = $maxIndex + 1;
        $res[$side . '_peak_pressure_value'] = $max;
        $res[$side . '_swing_phase'] = $req['data'][$index][$side]['swing'];
        $res[$side . '_stance_phase'] = $req['data'][$index][$side]['stance'];
        array_merge($res, $this->getStride($sensor, $side));
        array_merge($res, $this->getBalance($sensor, $side));
        return $res;
    }



    protected function responseRequestSuccess($ret)
    {
        return response()->json(['status' => 'สำเร็จ', 'data' => $ret], 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }

    protected function responseRequestError($message = 'Bad request', $statusCode = 404)
    {
        return response()->json(['status' => 'ผิดพลาด', 'message' => $message], $statusCode)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
    public function setMD5()
    {

        $passuniq = uniqid();
        $passmd5 = md5($passuniq);

        $sumlenght = strlen($passmd5); #num passmd5

        $letter_pre = chr(rand(97, 122)); #set char for prefix

        $letter_post = chr(rand(97, 122)); #set char for postfix

        $letter_mid = chr(rand(97, 122)); #set char for middle string

        $num_rand = rand(0, $sumlenght); #random for cut passmd5

        $cut_pre = substr($passmd5, 0, $num_rand); #cutmd5 start 0 stop $numrand
        $setmid = $cut_pre . $letter_mid; #set pre string + char middle

        $cut_post = substr($passmd5, $num_rand, $sumlenght + 1);

        $set_modify_md5 = $letter_pre . $setmid . $cut_post . $letter_post;
        return $set_modify_md5;
    }
}
