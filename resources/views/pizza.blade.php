@extends('layouts.app')

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

        <div class="col-sm-7">
            <!-- Esto no deberia ser asi -->
            {!! $chart->render() !!}
            <!-- Esto no deberia ser asi -->
        </div>
    </div>
@endsection
