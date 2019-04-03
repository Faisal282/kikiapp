@extends('layouts.app')
@section('style')
<style>
    .app{
        z-index: 100000 !important;
        height: 100vh !important;
        width: 100% !important;
        padding-top: 50vh;
        text-align: center;
        background-image: url("{{ asset('img/motorbg.jpg') }}");
        background-size: cover;
        background-repeat: no-repeat;
    }
    h1{
        color: white !important;
        width: 100% !important;
        transition: all ease-in-out .4s;
    }
    span{
        transition: all ease-in-out .4s;
    }
    span:hover{
        cursor: pointer;
        color: red;
        transition: all ease-in-out .4s;
    }
</style>
@endsection
@section('content')
    <div class="app">
        <h1>Selamat datang di aplikasi <span>MOTOR</span> Kami</h1>
    </div>
@endsection