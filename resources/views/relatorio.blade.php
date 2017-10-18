@extends('layouts.app')
<?php
    $ganancia_neta_total = 0;
    $costo_fijo_total = 0;
    $comision_total = 0;
    $lucro_total = 0;
?>
@section('content')
    <div class="row align-items-start">
        <div class="col-sm-3">
            <!-- form action="{{action('HomeController@relatorio')}}" -->
            <table class="table">
                <thead class="thead-inverse">
                    <tr>
                        <!-- th><i class="fa fa-check-square-o"></i></th -->
                        <th><i class="fa fa-check-square-o"></i>    Consultores</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consultores as $consultor)
                    <tr>
                        <!-- td><input type="checkbox" name="elegir[]" value="{{ $consultor->co_usuario }}"></td -->
                        <td>
                            <label class="form-check-label">
                                <input type="checkbox" name="elegir[]" value="{{ $consultor->co_usuario }}" class="form-check-input">
                                {{ $consultor->no_usuario }}
                            </label>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
        @include('periodo')

        <div class="col-sm-7" style="max-height: 620px; overflow-y: auto;">
            <!-- Esto no deberia ser asi -->
            <table class="table">
                @foreach ($consultores_aux as $consultor_aux)
                <thead class="thead-inverse">
                    <tr>
                        <th>{{ $consultor_aux->nombre_aux }}</th>
                        <th>Ganancia neta</th>
                        <th>Costo fijo</th>
                        <th>Comision</th>
                        <th>Lucro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($relatorio as $rel)
                        @if ($consultor_aux->nombre_aux == $rel->consultor)
                    <tr>
                        <td>{{ $rel->mes }}</td>
                        <td>$ {{ number_format($rel->ganancia_neta, 2, ',', '.') }}</td>
                        <td>$ {{ number_format($rel->costo_fijo, 2, ',', '.') }}</td>
                        <td>$ {{ number_format($rel->comision, 2, ',', '.') }}</td>
                        <td>$ {{ number_format($rel->ganancia_neta - ($rel->costo_fijo + $rel->comision), 2, ',', '.') }}</td>
                            <?php
                                $ganancia_neta_total = $ganancia_neta_total + $rel->ganancia_neta;
                                $costo_fijo_total = $costo_fijo_total + $rel->costo_fijo;
                                $comision_total = $comision_total + $rel->comision;
                                $lucro_total = $lucro_total + $rel->ganancia_neta - ($rel->costo_fijo + $rel->comision);
                            ?>
                    </tr>
                        @endif
                    @endforeach
                    <tr style="background-color: #c6c6c6">
                        <td>Totales</td>
                        <td><?php echo "$ ".number_format($ganancia_neta_total, 2, ',', '.'); ?></td>
                        <td><?php echo "$ ".number_format($costo_fijo_total, 2, ',', '.'); ?></td>
                        <td><?php echo "$ ".number_format($comision_total, 2, ',', '.'); ?></td>
                        <td><?php echo "$ ".number_format($lucro_total, 2, ',', '.'); ?></td>
                    </tr>
                </tbody>
                <?php
                    $ganancia_neta_total = 0;
                    $costo_fijo_total = 0;
                    $comision_total = 0;
                    $lucro_total = 0;
                ?>
                @endforeach
            </table>
            <!-- Esto no deberia ser asi -->

        </div>
    </div>
@endsection
