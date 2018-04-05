<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    
    public function get_products(Request $request){

        $content =[];
        if(\File::exists(storage_path('app/datajason/filejson.json'))){
            $data = \Storage::disk('jsondata')->get('filejson.json');
            $content = json_decode($data);
        }
        return response()->json($content);
    }

    public function store_products(Request $request){
        $inputs = $request->all();
        if($inputs['uid'] == '')
        {
            $this->add_product($inputs);
        }
        else
        {
            $this->edit_product($inputs);
        }

    }
    private function add_product($post)
    {
        if(\File::exists(storage_path('app/datajason/filejson.json'))){
            $data = \Storage::disk('jsondata')->get('filejson.json');
            $content = json_decode($data);
            $content[] = $post;
            $this->write_to_file($content);
        }else{
            $data = [];
            $data[] = $post;
            $this->write_to_file($data);
        }
        
    }

    private function edit_product($post){
        if(\File::exists(storage_path('app/datajason/filejson.json'))){
            $data = \Storage::disk('jsondata')->get('filejson.json');
            $content = json_decode($data);
            $content= $this->sort_data($content,$post );
            $this->write_to_file($content);
        }
    }
    private function sort_data($data, $post){
        $timestap = $post['uid'];
        $data_values=[];
        foreach ($data as $value) {
            if($value->timestamp == $timestap){
                $value->productname = $post['productname'];
                $value->quantinty = $post['quantinty'];
                $value->price = $post['price'];
                $data_values[]=$value;
            }else{
                $data_values[]=$value;
            }
        }
        return $data_values;

    }
    private function write_to_file($data)
    {
        \Storage::disk('jsondata')->put('filejson.json', json_encode($data));
    }
}





