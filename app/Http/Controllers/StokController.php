<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Stok;

class StokController extends Controller
{
    public function addMore(){
        $stok = Stok::all();
        return view("addMore",compact('stok'));
    }
    public function addMorePost(Request $r){
        $r->validate([
            'name' => 'required',
            'qty' => 'required',
            'price.*' => 'required',
        ]);
                
        foreach ($r->file('price') as $file){
            $filename = $file->getClientOriginalName();            
            $file->move(public_path('/file'), $filename);
            $data[] = $filename;
        }
        $stok        = new Stok;
        $stok->name  = $r->name;
        $stok->qty   = $r->qty;
        $stok->price = json_encode($data);
        $stok->save();

        return back()->with('success', 'Record Created Successfully.');
    }   
}