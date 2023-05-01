<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IpModel;

class IpController extends Controller
{

    public function addIP($ip)
    {
        if (IpModel::where("ip", $ip)->get()->first()->time_to_delete_request < now()) {
            IpModel::where("ip", $ip)->update(["request_counter" => 0, "time_to_delete_request" => now()->addMinute(1)]);
        }
        $request_counter = IpModel::where("ip", $ip)->get()->first()->request_counter;
        IpModel::where("ip", $ip)->update(["request_counter" => $request_counter + 1]);
    }

    public function getIpRequest($ip)
    {
        return IpModel::where("ip", $ip)->get()->first()->request_counter;
    }
}
