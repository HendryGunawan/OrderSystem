@extends('master')

@section('content')
<div class="container">
@include('flash::message')
Selamat Datang <?php echo Auth::user()->name  ?>.<br>
Silahkan pilih menu yang terdapat pada bagian kiri.
</div>

      
@endsection