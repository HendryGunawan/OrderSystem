@extends('master')

@section('content')
<div class="container">
@include('flash::message')
Welcome <?php echo Auth::user()->name  ?><br>
Please Select Menu on the left using Menu Button
</div>

      
@endsection