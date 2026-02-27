@extends('layouts.admin') <!-- nanti buat layout -->
@section('content')
<h1>Dashboard Admin</h1>
<p>Selamat datang, {{ Auth::user()->name }}</p>
@endsection