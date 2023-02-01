<?php

namespace App\Http\Controllers;

use App\Models\A;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AController extends Controller {
    
    public function list(Request $request){

        $pagination = A::orderBy("name");
        
        if (isset($request->search))
            $pagination->where("name","like","%$request->search%");
        
        return view("a.list", ["list"=>$pagination->paginate(5)]);
    }

    public function create(){
        return view("a.form", ["item"=>new A()]);
    }

    public function edit(A $a){
        return view("a.form",["item"=>$a]);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'name'    => 'required|string|max:255',
                ]);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        
        $data = $request->all();
        $a = A::create($data);
        return redirect(route("a.edit",$a))->with("success","Data saved!");
    }

    public function destroy(A $a){
        $a->delete();
        return redirect(route("a.list"))->with("success","Data deleted!");
    }

    public function update(A $a, Request $request) {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $a->update($data);
        return redirect()->back()->with("success","Data updated!");
    }
}
