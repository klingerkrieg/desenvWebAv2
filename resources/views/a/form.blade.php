@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastro de A</div>

                <div class="card-body">

                    @if ($item->exists)
                    <form method="POST" id='main' action="{{ route('a.update',$item) }}">
                        @method('PUT')
                        @csrf
                    @else
                    <form method="POST" id='main' action="{{ route('a.store') }}">
                        @csrf
                    @endif

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$item->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>

                    
                    <div class="row gap-2">
                
                        <button type="submit" class="btn btn-primary col-sm-2" form="main">
                            Salvar
                        </button>
            
                        <a href='{{route('a.create')}}' class="btn btn-secondary col-sm-2">
                            Novo
                        </a>
            
                        <a href='{{route('a.list')}}' class="btn btn-secondary col-sm-2">
                            Listar
                        </a>
                        @if ($item->exists)
                            <form name='delete' action="{{route('a.destroy',$item)}}" 
                                method="post"
                                class="col-sm-2"
                                style='display: inline-block;padding:0px;'>
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger" style='width:100%;'>
                                    Deletar
                                </button>
                            </form>
                        @endif
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>





    
    
</div>



@endsection
