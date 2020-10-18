@extends('template.backend.main')
@section('title')
SIDUKOPS
@endsection
@section('ribbon')
<ol class="breadcrumb">
    <li>Dashboard</li>
</ol>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 class="page-title txt-color-blueDark text-center well">
            <!-- PAGE HEADER -->
            BIG POP COFFEE
            <br>
            <small class="text-success">{{$user->name}}</small>
        </h1>
    </div>
</div>
@endsection
@section('js')

@endsection