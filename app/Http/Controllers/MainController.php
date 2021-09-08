<?php

namespace App\Http\Controllers;

use App\Http\Score\GetPoint;
use App\Http\Score\ScoreInterface;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{

    public function fetch($username)
    {
        $response = Http::get("https://api.github.com/users/$username/events/public");
        if ($response->status() == 200 ) {
            $score = 0;
            $arr = [];
            foreach ($response->json() as $item) {
                $data['type'] = $item['type'];
                $data['repository'] = $item['repo']['name'];
                $data['date'] = $item['created_at'];
                $service="App\Http\Score\\".$data['type'];
                if (is_a($service, ScoreInterface::class, true)) {
                    $service = new $service;
                    $point=$service->point();
                } else {
                    $point = 1;
                }
                $data['points'] = $point;
                array_push($arr, $data);
                $score += $point;
            }
           return response()->json(['data'=>$arr,'score'=>$score],200);
        }else{
            return response()->json(['error'=>$response->json()['message']],404);
        }
    }
}
