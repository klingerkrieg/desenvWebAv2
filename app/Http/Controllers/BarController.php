<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarController extends Controller
{
    public function list(Request $request){

        $pagination = Bar::orderBy("name");

        if (isset($request->search))
            $pagination->where("name","like","%$request->search%");

        return view("bar.list", ["list"=>$pagination->paginate(5)]);
    }

    public function create(){
        return view("bar.form", ["item"=>new Bar()]);
    }

    public function edit(Bar $bar){
        return view("bar.form",["item"=>$bar]);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'name'    => 'required|string|max:255',
                ]);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();

        $data = $request->all();
        $bar = Bar::create($data);
        return redirect(route("bar.edit",$bar))->with("success","Data saved!");
    }

    public function destroy(Bar $bar){
        $bar->delete();
        return redirect(route("bar.list"))->with("success","Data deleted!");
    }

    public function update(Bar $bar, Request $request) {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $bar->update($data);
        return redirect()->back()->with("success","Data updated!");
    }
}
