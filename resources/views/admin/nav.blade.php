<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
					
					<a href="{{ url('/admin') }}" id="show-shortcut" data-action="toggleShortcut">
						<img src="img/avatars/sunny.png" alt="me" class="online" /> 
						<span>
							{{ auth()->user()->name }} 
						</span>
						<i class="fa fa-angle-down"></i>
					</a> 
					
				</span>
			</div>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive-->
			<nav>
				<ul>
					<li class="active">
						<a href="{{ url('/admin') }}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">{{ trans('main.dashboard') }}</span></a>
					</li>
					<li class="">
						<a href="{{ url('/admin/settings') }}" title="Settings"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent">{{ trans('main.settings') }}</span></a>
					</li>

					<li class="@if(preg_match('/news|department_news/i',Request::segment(2))) open @endif">
						<a href="#" title=""><i class="fa fa-lg fa-fw fa-file"></i> 
						<span class="menu-item-parent">{{trans('main.news')}}</span></a>
						<ul @if(preg_match('/news|department_news/i',Request::segment(2))) style="display: block;" @endif>
							<li><a href="{{url(app('at').'/department_news')}}">{{trans('main.department_news')}}</a></li>
							<li><a href="{{url(app('aurl').'/news')}}">{{trans('main.news')}}</a></li>
						</ul>
					</li>

						<li class="@if(preg_match('/products|department_product/i',Request::segment(2))) open @endif">
						<a href="#" title=""><i class="fa fa-lg fa-fw fa-file"></i> 
						<span class="menu-item-parent">{{trans('main.products')}}</span></a>
						<ul @if(preg_match('/products|department_product/i',Request::segment(2))) style="display: block;" @endif>
							<li><a href="{{url(app('aurl').'/department_product')}}">{{trans('main.department_product')}}</a></li>
							<li><a href="{{url(app('aurl').'/products')}}">{{trans('main.products')}}</a></li>
						</ul>
					</li>

					
				</ul>
			</nav>
			<span class="minifyme" data-action="minifyMenu"> 
				<i class="fa fa-arrow-circle-left hit"></i> 
			</span>

		</aside>
		<!-- END NAVIGATION -->


			<!-- MAIN PANEL -->
		<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment"> 
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span> 
				</span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li><a href="{{ url(app('at')) }}">{{ trans('main.home') }}</a></li>

					 <?php $path_segment = 10; ?>
					 <?php $link         = ''; ?>

					@for($i=2;$i<=$path_segment;$i++)

						@if(!empty(Request::segment($i)) and !is_numeric(Request::segment($i)))

						<?php $link .= Request::segment($i).'/'; ?>

						<li><a href="{{ url(app('at').'/'.$link) }}">{{trans('main.'.Request::segment($i))}}</a></li>
						@endif
						
					@endfor
				</ol>
				<!-- end breadcrumb -->

				<!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right">
				<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
				<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
				<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
				</span> -->

			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">