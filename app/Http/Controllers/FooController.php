<?php

namespace App\Http\Controllers;

use App\Models\Foo;
use App\Models\Bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FooController extends Controller {

    public function list(Request $request){

        $pagination = Foo::orderBy("name");

        if (isset($request->search))
            $pagination->where("name","like","%$request->search%");

        return view("foo.list", ["list"=>$pagination->paginate(5)]);
    }

    public function create(){
        return view("foo.form", ["item"=>new Foo()]);
    }

    public function edit(Foo $foo){
        return view("foo.form",["item"=>$foo]);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'name'    => 'required|string|max:255',
                ]);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();

        $data = $request->all();
        $foo = Foo::create($data);
        return redirect(route("foo.edit",$foo))->with("success","Data saved!");
    }

    public function destroy(Foo $foo){
        $foo->delete();
        return redirect(route("foo.list"))->with("success","Data deleted!");
    }

    public function update(Foo $foo, Request $request) {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $foo->update($data);
        return redirect()->back()->with("success","Data updated!");
    }
}
