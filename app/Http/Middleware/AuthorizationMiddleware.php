<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\IpModel;
use App\Http\Controllers\IpController;

class AuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        echo $ip;
        if (IpModel::where("ip", $ip)->get()->first() == null) {
            IpModel::create(["ip" => $ip, "request_counter" => 0, "time_to_delete_request" => null, "banned" => false]);
        }
        if (IpModel::where("ip", $ip)->get()->first()->banned == 1) {
            return redirect("/error/banned");
        }
        if ($request->header('Authorization') != '$xv1623tty') {
            $ipController = new IpController();
            $ipController->addIP($ip);
            if ($ipController->getIpRequest($ip) >= 30) {
                if (IpModel::where("ip", $ip)->get()->first()->time_to_delete_request >= now()) {
                    IpModel::where("ip", $ip)->update(["banned" => true]);
                }
            }
            return redirect("/error/noKey");
        } else {
            return $next($request);
        }
    }
}
