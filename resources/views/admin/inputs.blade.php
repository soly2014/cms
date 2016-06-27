

@foreach($input_name as $key => $value)
		@foreach(app('language') as $lang)
			@if($key == 'text')
				<section>
				 <label class="input"> 

				 {{trans('main.'.$lang.$value)}}

					<input type="text" name="{{$lang.$value}}"
					@if($mode == 'old')
					 value="{{old($lang.$value)}}" 
					@elseif($mode == 'data')
					 value="{{$data->{$lang.$value} }}" 
					@endif
					  placeholder="{{trans('main.'.$lang.$value)}}"
					@foreach($css as $k => $v)
					 {{$k}}="{{$v}}"  
					@endforeach
					>
					<p class="help-block">{{$errors->first($lang.$value)}}</p>
				  </label>
				 </section>
			 @elseif($key == 'textarea')	
						 <section>
							<label class="label"> {{trans('main.'.$lang.$value)}} </label>
							<label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
							<textarea  name="{{$lang.$value}}"  placeholder="{{trans('main.'.$lang.$value)}}"
										@foreach($css as $k => $v)
										 {{$k}}="{{$v}}" &nbsp;
										@endforeach
							>@if($mode == 'old'){{old($lang.$value)}}@elseif($mode == 'data'){{$data->{$lang.$value} }}@endif</textarea> 
							<p class="help-block">{{$errors->first($lang.$value)}}</p>
						</label>
				   </section>
		  	@endif
		@endforeach

@endforeach

 