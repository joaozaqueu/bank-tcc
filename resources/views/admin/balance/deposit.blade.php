@extends('adminlte::page')

@section('title', 'Novo Deposito')

@section('content_header')
    <h1>Depósito</h1>
@stop

@section('content')
    
    <div class="box">
        <div class="box-header">
            <h3>Novo Deposito</h3>
        </div>
        <div class="box-body">
            @include('admin.helpers.messages')

            <form method="POST" action="{{ route('balance.store') }}">
                {!! csrf_field() !!}

                <div class="form-group">
                    <input type="text" name="value" placeholder="Valor Recarga" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Recarregar</button>
                </div>
            </form>
        </div>
    </div> 

@stop