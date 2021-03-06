@extends('adminlte::page')

@section('title', 'Cheef MANAGER')

@section('content_header')
    <h1>Saldo</h1>
@stop

@section('content')
    <div class="box">
    	<div class="box-header">
    		<a href="{{ route('balance.deposit') }}" class="btn btn-primary">Recarga</a>
    		<a href="" class="btn btn-warning">Sacar</a>
    	</div>
    	<div class="box-body">

    		<div class="small-box bg-green">
            <div class="inner">
              <h3>{{ number_format($amount, 2, ',', '.') }}</h3>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">Histórico <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    	</div>
    </div>
@stop