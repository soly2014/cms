@extends(app('at').'.index')
@section('admin')
 <a href="{{url(app('aurl').'/news/create')}}" class="btn btn-info">{{trans('main.add')}}</a>
 
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
		 						<td>{{ trans('main.en_title') }}</td>
		 						<td>{{trans('main.action')}}</td>
		 					</tr>	
		 					@foreach($allneews as $news)
		 					<tr>
		 						<td>{{ $news->en_title }}</td> 
		 						<td>
		 							<a href="{{url(app('aurl').'/news/'.$news->id.'/edit')}}" class="btn btn-info">{{trans('main.edit')}}</a>
		 							{!! Form::open(['method'=>'delete','url'=>app('aurl').'/news/'.$news->id,'style'=>'display:inline','class'=>'form'.$news->id]) !!}
		 							<a href="#" class="btn btn-danger delete_this" formid="{{$news->id}}">{{trans('main.delete')}}</a>
		 							{!! Form::close() !!}
		 						</td>
		 					</tr>
		 					@endforeach
		 				</table>					
					 {!! str_replace('/?','?',$allneews->render()) !!}
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->	
			 

@stop