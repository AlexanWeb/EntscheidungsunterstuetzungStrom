@extends('layouts.app')

@section('content')
    Home
    {!! $chart->container() !!}
    {!! $chart->script() !!}

@endsection
