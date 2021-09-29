<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Regions;
use App\Models\Communes;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\Input;

class CustomersController extends Controller
{
    public function add(Request $request){
        Log::stack(['slack', 'single'])->info("Se esta creando un Customer");

        $commune = Communes::where(
            'id_com', $request->id_com
        )->first();

        if($commune->id_reg != $request->id_reg){
            return response()->json([
                'error'=> "La region no pertenece a la commune",
                "success" => false
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'dni' => 'required|unique:customers,dni',
            'email' => 'required|email',
            'id_reg' => 'required|exists:communes,id_reg',
            'id_com' => 'required|exists:communes,id_com',
            'name' => 'required',
            'last_name' => 'required',
            'status' => 'in:A,I'
        ]);

        if ($validator->fails()) {
            Log::stack(['slack', 'single'])->info($validator->errors());
            return response()->json([
                'error'=>$validator->errors(),
                "success" => false
            ], 422);
        }

        $input = $request->all();
        $input['date_reg'] = date('Y-m-d H:i');
        $customer = Customers::create($input);
        Log::stack(['slack', 'single'])->info("Se creo un Customer: $customer");
        return response()->json(
            [
            'customer' => $customer,
            'success' => true
        ], 200);
    }

    public function delete(Request $request){
        Log::stack(['slack', 'single'])->info("Se eliminara un Customer");
        $validator = Validator::make($request->all(), [
            'dni' => 'required|exists:customers,dni'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors(),
                "success" => false
            ], 422);
        }

        $customer = Customers::where('dni', $request->dni)->first();

        if($customer->status == "trash"){
            Log::stack(['slack', 'single'])->info("Error Registro no existe");
            return response()->json([
                'error'=> 'Registro no existe',
                "success" => false
            ], 422);
        }

        $customer->status = 'trash';
        $customer->save();
        Log::stack(['slack', 'single'])->info("Customer Eliminado");
        return response()->json(
            [
            'customer' => "Customer Eliminado",
            'success' => true
        ], 200);
    }

    public function search(Request $request){
        Log::stack(['slack', 'single'])->info("Buscando Customer");
        if($request->email == null && $request->dni == null){
            Log::stack(['slack', 'single'])->info("Error Se necesita al menos un dato: email o dni");
            return response()->json([
                'error'=> 'Se necesita al menos un dato: email o dni',
                "success" => false
            ], 422);
        }

        if(!empty($request->email)){
            $customer = Customers::where(
                'email', $request->email
            )->first();
        }else{
            $customer = Customers::where(
            'dni', $request->dni
            )->first();
        }
        if($customer->status == "trash" || $customer->status == "I"){
            return response()->json([
                'error'=> 'Registro no existe',
                "success" => false
            ], 422);
        }

        $region = Regions::where(
            'id_reg', $customer->id_reg
        )->first();

        $commune = Communes::where(
            'id_com', $customer->id_com
        )->first();

        Log::stack(['slack', 'single'])->info("El customer se consulto con exito");

        return response()->json(
            [
            'lastName' => $customer->last_name,
            'address' => $customer->address,
            'region' => $region->description,
            'commune' => $commune->description,
            'success' => true
        ], 200);
    }
}
