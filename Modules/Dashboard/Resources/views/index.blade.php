@extends('admin.layouts.master')
@section('title', " ".trans('menu.sidebar.dashboard')." ".trans('menu.pipe')." " .app_name(). " Admin")
@section('content')
    <section class="content-header">
      <h1>Statistic</h1>
      <ol class="breadcrumb">
        <li><a href="{{route('backend.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
      <section class="content" style="min-height: 100px;">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>0</h3>
              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </section>
@endsection
