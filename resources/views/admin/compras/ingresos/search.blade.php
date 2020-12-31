{!! Form::open(['route'=>'ingresos.index','method'=>'GET','class'=>'form-search content-search navbar-form','role'=>'search'])!!}
	<div class="input-group">
			<input type="text" name="search" class="form-control form-text" type="text" size="15" maxlength="128" placeholder="Buscar">

			<span class="input-group-btn">

                <button type="submit" class="btn btn-primary">
                	<span class="fa fa-search" aria-hidden="true"></span>
                </button>
			</span>
	</div>

{!!Form::close()!!}

