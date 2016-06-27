@if(session()->has('success'))
<div class="alert alert-success">
	<h1>{{session()->get('success')}}</h1>
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger">
	<h1>{{session()->get('error')}}</h1>
</div>
@endif