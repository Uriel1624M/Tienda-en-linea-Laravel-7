<div class="card">
  <div class="card-body">
    {!! Form::open(['route'=>'orders.index', 'method'=>'GET','class'=>'form-search content-search navbar-form','role'=>'search']) !!}

        <div class="row">
          <div class="col-md-3">

            <div class="form-group">
              <label>Fecha inicio</label>
              {!!
                      Form::date('fecha_inicio', \Carbon\Carbon::now(),['class'=>'form-control']);
              !!}
            </div>

          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Fecha Final </label>
            {!!Form::date('fecha_final', \Carbon\Carbon::now(),['class'=>'form-control']);
            !!}     
            </div>
          </div>
          
          <div class="col-md-3">
            
            {!!Form::submit('Buscar', array('class'=>'btn btn-success'))!!}
                        

          </div>
          
        </div>
      {!! Form::close() !!}
  </div>

</div>  
