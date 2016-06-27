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
							
							@if (count($errors) > 0)
							    <div class="alert alert-danger">
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li>{{ $error }}</li>
							            @endforeach
							        </ul>
							    </div>
							@endif

				{!! Form::open(['route'=>app('aurl').'.news.store','id'=>'review-form','class'=>'smart-form','files'=>true]) !!}
							<header>
								{{$title}} 
							</header>

							<fieldset>
						    	{!! Forms::Input(['text'=>'_title'],['class'=>'form-control'],app('at'),'old') !!}
							</fieldset>

							<!--  -->
							<fieldset>
							    {!! Form::label('dep',trans('main.photo_news')) !!}
						    	{!! Form::file('photo',['class'=>'form-control']) !!}
						    	<p class="help-block">{{$errors->first('photo')}}</p>
							</fieldset>


							<fieldset>
						    	{!! Forms::Input(['textarea'=>'_content'],['class'=>'form-control ckeditor'],app('at'),'old') !!}
							</fieldset>

							<fieldset>
							 {!! Form::label('dep',trans('main.department')) !!}
							 {!! Form::select('dep_id',$alldep,old('dep_id'),['class'=>'form-control']) !!}
							</fieldset>
							<footer>
								<button type="submit" class="btn btn-primary">
									{{trans('main.add')}}
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