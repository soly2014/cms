@extends(app('at').'.index')
@section('admin')
 <a href="{{url(app('aurl').'/department_news/create')}}" class="btn btn-info">{{trans('main.add')}}</a>
 
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
						
		 				<table class="table table-striped table-bordered table-hovered">
		 					<tr>
		 						@foreach(app('language') as $lang)
		 						<td>{{ trans('main.'.$lang.'_name') }}</td>
		 						@endforeach
		 						<td>{{trans('main.action')}}</td>
		 					</tr>	
		 					@foreach($alldep as $dep)
		 					<tr>
		 						@foreach(app('language') as $lang)
		 						<td>{{ $dep->{$lang.'_name'} }}</td>
		 						@endforeach
		 						<td>
		 							<a href="{{url(app('aurl').'/department_news/'.$dep->id.'/edit')}}" class="btn btn-info">

		 							{{trans('main.edit')}}</a>
		 							{!! Form::open(['method'=>'delete','url'=>app('aurl').'/department_news/'.$dep->id,'style'=>'display:inline','class'=>'form'.$dep->id]) !!}
		 						
		 						<a href="#" class="btn btn-danger delete_this" formid="{{$dep->id}}">{{trans('main.delete')}}</a>
		 							{!! Form::close() !!}
		 						</td>
		 					</tr>
		 					@endforeach
		 				</table>					
						
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->	
		 

@stop
