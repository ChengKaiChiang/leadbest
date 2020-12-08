<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Database\QueryException;
use \App\Models\Balance;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Balance::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'balance' => 'required | integer',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $validatedData = $validator->validate();

        try {
            $user_id = $validatedData['user_id'];
            $count = Balance::where('user_id', $user_id)->count();
            if ($count == 0) {
                $balance = $validatedData['balance'];
                Balance::create([
                    'user_id' => $user_id,
                    'balance' => $balance,
                ]);
            }else{
                return response('user id is repeat', 400);
            }
        } catch (QueryException $e) {
            return response()->json($e->getMessage(), 400);
        }
        return response()->json(true, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
