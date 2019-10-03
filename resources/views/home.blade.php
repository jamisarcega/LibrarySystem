@extends('layouts.user-layout')
@section('user')
    Hello, {{ Auth::user()->first_name }}
@endsection
@section('header')
    Dashboard
@endsection
@section('page')
   Dashboard
@endsection
@section('content')

@endsection
