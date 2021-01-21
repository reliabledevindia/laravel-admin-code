@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                     {!! Form::open(['route' =>'user.voteForPoll','class'=>'form-horizontal','id'=>'validateForm']) !!}
                    <form method="post" action="https://poll.pollcode.com/64282184">
                        <div style="background-color:#EEEEEE;padding:10px;font-family:Comic Sans MS;font-size:small;color:#2E230E;box-shadow: 0px 0px 5px #888;">
                            @if(count($polls)>0)
                                @foreach($polls as $poll)
                                    <div style="padding:2px 0px 4px 2px;">
                                        <strong>{!!$poll->question!!}</strong>
                                    </div>
                                    <div class="ermsg">
                                    @foreach($poll->options as $list)
                                        {{ Form::radio("answer[$poll->id]", $list->id, false, ['style'=>'float:left;','id'=>"answer$list->id",'required']) }}
                                        <label for="answer{{$list->id}}" style="float:left;width:150px;">
                                          &nbsp;  {!! $list->name !!}
                                        </label>
                                        <div style="clear:both;height:2px;"></div>
                                    @endforeach
                                    </div>
                                @endforeach
                                <div align="center" style="padding:3px;"><button class="btn btn-primary" type="submit">@lang('menu.vote')</button></div>
                            @else
                                Poll Not Found
                            @endif
                       </div>
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
