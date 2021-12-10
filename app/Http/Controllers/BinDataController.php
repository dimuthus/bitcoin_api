<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BinDataController extends Controller
{
    function getData(Request $request){
        $startDate=$request->form_date;
        $endDate=$request->to_date;
        $url='https://api.coindesk.com/v1/bpi/historical/close.json?start='.$startDate.'&end='.$endDate.'&index=[USD]';
        $res =Http::get($url);
        $obj= json_decode( $res->getBody()); 
        $assoc=$obj->bpi;
        $dates=[];
        $bvalue=[];
        foreach ($assoc as $key => $value) {
            $dates['dates'][]=$key;
            $bvalue['values'][]=$value;
        }
        $result=array_merge($dates,$bvalue);
        $myString=json_encode($result);
        return $myString;
    }
}
