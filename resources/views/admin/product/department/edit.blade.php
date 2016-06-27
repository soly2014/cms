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
						
						{!! Form::open(['url'=>app('aurl').'/department_product/'.$edit->id,'method'=>'put','id'=>'review-form','class'=>'smart-form']) !!}
							<header>
								{{$title}} 
							</header>

							<fieldset>

						    	{!! Forms::Input(['text'=>'_name'],['class'=>'form-control'],app('at'),'data',$edit) !!}
							
							</fieldset>
							@if(count($department) > 0 and $edit->parent > 0)
							<script type="text/javascript">
							$(document).on('click','.movedep',function(){
								$('.updatedepartment').toggleClass('hidden'); 
								return false;
							});
							</script>
							<div class="form-group">
							 <a href="#" class="btn btn-danger movedep">{{trans('main.move_department')}}</a>
							</div>
							 
						   <div class="updatedepartment hidden">
							<script type="text/javascript">
							$(document).on('change','.checkparent',function(){
								var parent = $('option:selected',this).val();
								var master = $('option:selected',this).attr('master');
								 
										if(parent == '' || parent == null || master == 'master')
										{
											$('.result').empty();
										}else{
											
											$.ajax({
												url:'{{url(app('aurl').'/department_product/check/parent')}}',
												type:'post',
												dataType:'json',
												data:{parent:parent,'_token':'{!! csrf_token() !!}'},
												beforeSend: function()
												{
													$('.spin_dep').removeClass('hidden');
												},success: function(data)
												{
													if(data != 'false')
													{
												    	$('.result').append(data);
													}
													$('.spin_dep').addClass('hidden');
												},error: function()
												{
													$('.spin_dep').addClass('hidden');
												}
											}); 
										}

							});	
							</script>
							<fieldset>
							<label>{{trans('main.sub_to')}}</label>	
							{!! Form::select('parent',$department,old('parent'),['class'=>'form-control checkparent','placeholder'=>trans('main.master_department')]) !!}
							</fieldset>
							@endif
							<div class="result">

							</div>
								<p><i class="fa fa-spinner fa-spin fa-2x hidden spin_dep"></i></p>
							</div>	

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