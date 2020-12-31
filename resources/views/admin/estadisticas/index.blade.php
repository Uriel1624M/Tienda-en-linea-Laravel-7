@extends('admin.template')

@section('content')
<div class="container text-center">

	<div class="page-header">
			<h1>
			 <i class="fa fa-users"></i>	Estadisticas
				
			</h1>

		</div>


	  <div class="row">
	    <div class="col-6">

		    <div class="bg-white h-auto w-3/4 rounded-lg shadow-md border border-teal-500 mr-2">
		            {!! $Ventaschart->container() !!}
		            {!! $Ventaschart->script() !!}
		    </div>
	    </div>

	    <div class="col-6">
	     <div class="bg-white h-auto w-3/4 rounded-lg shadow-md border border-teal-500 mr-2">

		         {!! $Compraschart->container() !!}
	             {!! $Compraschart->script() !!}
	      </div>
	    </div>
	  </div>

	  <div class="row">
	  	<div class="col-6">
	  	 <div class="bg-white h-auto w-3/4 rounded-lg shadow-md border border-teal-500 mr-2">

	           {!! $masvendidochart->container() !!}
	            {!! $masvendidochart->script() !!}
	        </div>
	    </div>
	  </div>
	  <hr>
</div>
@stop

