<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Mqtt;

class MqttController extends BaseController{
    public function index(){
        $data = Mqtt::all();
        return response($data);
    }

    public function show($id){
        $data = Mqtt::where('id', $id)->get();

        if(count($data) > 0){
            return response ($data);
        }else{
            return response('No hay datoss');
        }
    }
    public function getDataTopic($topic){
        $data = Mqtt::where('topic', str_replace("|", "/", $topic))->get();
        if(count($data) > 0){
            return response()->json(['data' => $data], 200);
        }else{
            return response()->json(['message' => 'No hay datos'], 404);
        }
    }
    public function store(Request $request){
        $data = new Mqtt;

        if($request->input('topic')){
            $data->topic = $request->input('topic');
        }else{
            return response('No hay topic');
        }

        if($request->input('value')){
            $data->value = $request->input('value');
        }else{
            return response('No hay value');
        }
        
        if($request->input('fecha')){
            $data->fecha = $request->input('fecha');
        }else{
            return response('no hay fecha');
        }
        
        $data->save();

        return response('Successful insert');
    }

    public function update(Request $request, $id){
        $data = Mqtt::where('id',$id)->first();

        if($request->input('topic')){
            $data->topic = $request->input('topic');
        }else{
            return response('No hay topic');
        }

        if($request->input('value')){
            $data->value = $request->input('value');
        }else{
            return response('no hay value');
        }

        if($request->input('fecha')){
            $data->fecha = $request->input('fecha');
        }else{
            return response('No hay fecha');
        }

        $data->save();
    
        return response('Successful update');
    }

    public function destroy($id){
        $data = Mqtt::where('id',$id)->first();
        $data->delete();

        return response('Successful delete');
    }
}