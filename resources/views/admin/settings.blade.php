@extends(app('at').'.index')
@section('admin')


<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-7" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
				<header> 
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>{{$title}} </h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						{!! Form::open(['url'=>url()->current(),'id'=>'review-form','class'=>'smart-form']) !!}
							<header>
								{{$title}} 
							</header>


							<fieldset>

	{!! App\Http\Controllers\Forms::Input(['text'=>'_sitename'],['class'=>'form-control'],app('at'),'data',$setting) !!}

								<section>
									<label class="input"> <i class="icon-append fa fa-link"></i>
										<input type="text" name="url" value="{{$setting->url}}" id="name" placeholder="{{trans('main.web_url')}}">
									</label>
								</section>

								<section>
									<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
										<input type="email" name="email" value="{{$setting->email}}" id="email" placeholder="{{trans('main.email')}}">
									</label>
								</section>

								<section>
									<label class="label"></label>
									<label class="textarea"> <i class="icon-append fa fa-comment"></i>							
									<textarea rows="3" name="keywords" id="review"
									 placeholder="{{trans('main.keywords')}}">{{$setting->keywords}}</textarea> 
									</label>
								</section>

								<section>
									<label class="label"></label>
									<label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
									<textarea rows="3" name="description" id="review" 
									placeholder="{{trans('main.description')}}">{{$setting->description}}</textarea> 
									</label>
								</section>

								<section>
									<label class="label">{{trans('main.maintenance')}}</label>
									<label class="select"> <i class="icon-append fa fa-comment"></i> 										
									 {!! Form::select('maintenance',['0'=>trans('main.close'),'1'=>trans('main.open')],$setting->maintenance) !!}
									</label>
								</section>


								<section>
									<label class="label"></label>
									<label class="textarea"> <i class="icon-append fa fa-comment"></i> 										
										<textarea rows="3" name="maintenance_message" id="review" placeholder="{{trans('main.maintenance_message')}}">{{$setting->maintenance_message}}</textarea> 
									</label>
								</section>


							
							</fieldset>
							<footer>
								<button type="submit" class="btn btn-primary">
									{{trans('main.save')}}
								</button>
							</footer>
						{!! Form::close() !!}						
						
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->	
					
@stop