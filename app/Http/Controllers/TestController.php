<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        setcookie("color", "red");
        var_dump($_COOKIE["color"]);
    }

    //
    public function printNumbers(Request $request)
    {
        $input = $request->input('input');

        $factor_arr = array();
        $i = 1;
        while ($i <= $input) {
            if ($input % $i == 0) {
                array_push($factor_arr, $i);
            }
            $i += 1;
        }

        $prime_arr = array();
        if ($input >= 2)
            array_push($prime_arr, 2);

        for ($j = 3; $j <= $input; $j += 2) {
            $is_prime = true;
            for ($i = 2; $i < $j; $i++) {
                if ($j % $i == 0) {
                    $is_prime = false;
                }
            }

            if ($is_prime)
                array_push($prime_arr, $j);
        }

        $factor_prime = array_intersect($factor_arr, $prime_arr);

        return response()->json(["Factor" => $factor_arr, "Prime" => $prime_arr, "Factor Prime" => $factor_prime], 200);
    }
}
