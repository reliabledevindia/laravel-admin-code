 <div class="panel-body">
    <div class="form-group">
      <label class="col-sm-2 control-label">{{trans($model.'::menu.sidebar.form.question')}} <span class="asterisk">*</span></label>
      <div class="col-sm-10 ermsg">
          {{ Form::text('question',null, ['required','class'=>'form-control','id'=>'question','placeholder'=>trans('menu.placeholder.question'),'title'=>trans('menu.validiation.please_enter_question'),'maxlength'=>250]) }}
      </div>
    </div>
    @isset($data)
	    @foreach($data->options as $key => $list)
	    @php $k = $key+1; @endphp
	    <div class="form-group">
	      <label class="col-sm-2 control-label">{{trans($model.'::menu.sidebar.form.option'.$k)}} <span class="asterisk">*</span></label>
	      <div class="col-sm-10 ermsg">
	          {{ Form::text("option[$list->id]",$list->name, ['required','class'=>'form-control','id'=>"option$k",'placeholder'=>trans('menu.placeholder.option'),'title'=>trans('menu.validiation.please_enter_option'),'maxlength'=>250]) }}
	      </div>
	    </div>
	    @endforeach
   @else
	    <div class="form-group">
	      <label class="col-sm-2 control-label">{{trans($model.'::menu.sidebar.form.option1')}} <span class="asterisk">*</span></label>
	      <div class="col-sm-10 ermsg">
	          {{ Form::text('option[1]',null, ['required','class'=>'form-control','id'=>'option1','placeholder'=>trans('menu.placeholder.option'),'title'=>trans('menu.validiation.please_enter_option'),'maxlength'=>250]) }}
	      </div>
	   </div>
	    <div class="form-group">
	      <label class="col-sm-2 control-label">{{trans($model.'::menu.sidebar.form.option2')}} <span class="asterisk">*</span></label>
	      <div class="col-sm-10 ermsg">
	          {{ Form::text('option[2]',null, ['required','class'=>'form-control','id'=>'option2','placeholder'=>trans('menu.placeholder.option'),'title'=>trans('menu.validiation.please_enter_option'),'maxlength'=>250]) }}
	      </div>
	   </div>
	    <div class="form-group">
	      <label class="col-sm-2 control-label">{{trans($model.'::menu.sidebar.form.option3')}} <span class="asterisk">*</span></label>
	      <div class="col-sm-10 ermsg">
	          {{ Form::text('option[3]',null, ['required','class'=>'form-control','id'=>'option3','placeholder'=>trans('menu.placeholder.option'),'title'=>trans('menu.validiation.please_enter_option'),'maxlength'=>250]) }}
	      </div>
	   </div>
	    <div class="form-group">
	      <label class="col-sm-2 control-label">{{trans($model.'::menu.sidebar.form.option4')}} <span class="asterisk">*</span></label>
	      <div class="col-sm-10 ermsg">
	          {{ Form::text('option[4]',null, ['required','class'=>'form-control','id'=>'option4','placeholder'=>trans('menu.placeholder.option'),'title'=>trans('menu.validiation.please_enter_option'),'maxlength'=>250]) }}
	      </div>
	   </div>
   @endif
</div>