<style type="text/css">
	.alerta {
	    margin:10px;
	    padding:12px;
	    border:2px solid #666;
	    width:100%;
	    position: absolute;
	    display: none;
	    background-color: #fff;
	    
	}
</style>

<div class="col-sm-2">
    <div class="card text-center">
        <div class="card-header"><i class="fa fa-calendar fa-fw"></i>    Desde</div>
            <div class="card-block">
				<div class="form-inline">
					<!-- label for="mes" class="mr-sm-2">Mes</label -->
					<select class="custom-select mb-2 mr-sm-2 ml-sm-2 mb-sm-0" name="mesde" id="mesde" data-parsley-required="true">
						@foreach ($meses as $mes)
							<option value="{{ $mes->numero }}">{{ $mes->nombre }}</option>
						@endforeach
					</select>

					<!-- label for="año" class="mr-sm-2">Año</label -->
					<select class="custom-select mb-2 mr-sm-2 ml-sm-2 mb-sm-0" name="añosde" id="añosde" data-parsley-required="true">
						@foreach ($años as $año)
							<option value="{{ $año->años }}">{{ $año->años }}</option>
						@endforeach
					</select>
				</div>
				<br>
				<div class="form-inline">
					<!-- label for="mes" class="mr-sm-2">Mes</label -->
					<select class="custom-select mb-2 mr-sm-2 ml-sm-2 mb-sm-0" name="mesta" id="mesta" data-parsley-required="true">
						@foreach ($meses as $mes)
							<option value="{{ $mes->numero }}">{{ $mes->nombre }}</option>
						@endforeach
					</select>

					<!-- label for="año" class="mr-sm-2">Año</label -->
					<select class="custom-select mb-2 mr-sm-2 ml-sm-2 mb-sm-0" name="añosta" id="añosta" data-parsley-required="true">
						@foreach ($años as $año)
							<option value="{{ $año->años }}">{{ $año->años }}</option>
						@endforeach
					</select>
				</div>
            </div>
        <div class="card-footer"><i class="fa fa-calendar fa-fw"></i>    Hasta</div>
    </div>

    <div class="card text-center">
        <div class="card-header">Accion</div>
            <div class="card-block">
                <br><button type="submit" class="btn btn-primary" id="relatorio" onmouseover="$('#mainForm').attr('action', '{{ action("HomeController@relatorio") }}');" onclick="marca = $('input[type=checkbox]:checked').length; if(!marca) { return false; }"><img src="{{ ('img/icone_relatorio.png') }}" style="padding-right: 10px;">Relatorio</button><br>
                <br><button type="submit" class="btn btn-primary" id="grafica" onmouseover="$('#mainForm').attr('action', '{{ action("HomeController@grafica") }}');" onclick="marca = $('input[type=checkbox]:checked').length; if(!marca) { return false; }"><img src="{{ ('img/icone_grafico.png') }}" style="padding-right: 20px;">Grafico</button><br>
                <br><button type="submit" class="btn btn-primary" id="pizza" onmouseover="$('#mainForm').attr('action', '{{ action("HomeController@pizza") }}');" onclick="marca = $('input[type=checkbox]:checked').length; if(!marca) { return false; }"><img src="{{ ('img/icone_pizza.png') }}" style="padding-right: 30px;">Pizza</button><br><br>
            	<div class="alerta">Seleccione un consultor</div>
            </div>
        <div class="card-footer">Accion</div>
    <!-- /form -->
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
	    
	        $('.btn').click(mostrar).mouseleave(ocultar);
	    
	        function mostrar(e){
	            $('.alerta').fadeIn().css(({ left:  e.pageX-100, top: e.pageY-350 }));
	        }
	        
	        function ocultar(){
	            $('.alerta').fadeOut(1500);
	        }
	    });
</script>