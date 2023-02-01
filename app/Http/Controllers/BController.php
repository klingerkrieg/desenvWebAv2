<?php

namespace App\Http\Controllers;

use App\Models\B;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BController extends Controller
{
    public function list(Request $request){

        $pagination = B::orderBy("name");
        
        if (isset($request->search))
            $pagination->where("name","like","%$request->search%");
        
        return view("b.list", ["list"=>$pagination->paginate(5)]);
    }

    public function create(){
        return view("b.form", ["item"=>new B()]);
    }

    public function edit(B $b){
        return view("b.form",["item"=>$b]);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'name'    => 'required|string|max:255',
                ]);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        
        $data = $request->all();
        $b = B::create($data);
        return redirect(route("b.edit",$b))->with("success","Data saved!");
    }

    public function destroy(B $b){
        $b->delete();
        return redirect(route("b.list"))->with("success","Data deleted!");
    }

    public function update(B $b, Request $request) {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $b->update($data);
        return redirect()->back()->with("success","Data updated!");
    }
}
