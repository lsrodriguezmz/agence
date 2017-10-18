<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Charts, App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function consultores()
    {
        $meses = DB::select('SELECT DISTINCT MONTH(data_emissao) AS numero, MONTHNAME(data_emissao) AS nombre FROM cao_fatura');

        $años = DB::select('SELECT DISTINCT YEAR(data_emissao) AS años FROM cao_fatura');

        $consultores = DB::select('SELECT a.no_usuario, a.co_usuario FROM cao_usuario a
                                    JOIN permissao_sistema b ON a.co_usuario = b.co_usuario
                                    WHERE b.co_sistema = 1 AND b.in_ativo = "S" AND b.co_tipo_usuario IN (0,1,2)
                                    ORDER BY a.no_usuario ASC');
        //dd($consultores);
        return view('consultores', ['consultores' => $consultores, 'meses' => $meses, 'años' => $años]);
    }



    public function relatorio(Request $request)
    {
        $meses = DB::select('SELECT DISTINCT MONTH(data_emissao) AS numero, MONTHNAME(data_emissao) AS nombre FROM cao_fatura');

        $años = DB::select('SELECT DISTINCT YEAR(data_emissao) AS años FROM cao_fatura');

        $consultores = DB::select('SELECT a.no_usuario, a.co_usuario FROM cao_usuario a
                                    JOIN permissao_sistema b ON a.co_usuario = b.co_usuario
                                    WHERE b.co_sistema = 1 AND b.in_ativo = "S" AND b.co_tipo_usuario IN (0,1,2)
                                    ORDER BY a.no_usuario ASC');
        //dd($consultores);

        //Fecha desde
        $femesde = $request->input('mesde');
        $añosde = $request->input('añosde');
        
        //Fecha hasta
        $femesta = $request->input('mesta');
        $añosta = $request->input('añosta');
        
        //opciones checkbox
        $elegidos = $request->input('elegir');
        $in = '"'.implode('","', $elegidos).'"';// VALIDAR QUE NO ESTE VACIO
        //dd($femesde, $elegidos);
        
        DB::select('SET sql_mode=(SELECT REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY",""));');

        $consultores_aux = DB::select('SELECT u.no_usuario AS nombre_aux
                                    FROM cao_fatura f
                                    JOIN cao_os o ON o.co_os = f.co_os
                                    JOIN cao_usuario u ON u.co_usuario = o.co_usuario
                                    JOIN cao_salario s ON u.co_usuario = s.co_usuario
                                    WHERE o.co_usuario IN ('.$in.') AND
                                        MONTH(f.data_emissao) BETWEEN '.$femesde.' AND '.$femesta.' AND
                                        YEAR(f.data_emissao) BETWEEN '.$añosde.' AND '.$añosta.'
                                    GROUP BY nombre_aux
                                    ORDER BY nombre_aux ASC, MONTH(f.data_emissao) ASC
                                    ');


        $relatorio = DB::select('SELECT u.no_usuario AS consultor,
                                    MONTHNAME(f.data_emissao) AS mes,
                                    ROUND(SUM(f.valor - (f.total_imp_inc/100)*f.valor),2) AS ganancia_neta,
                                    ROUND(s.brut_salario, 2) AS costo_fijo,
                                    ROUND(((f.valor - (f.valor*(f.total_imp_inc/100))) * (f.comissao_cn/100)),2) AS comision
                                FROM cao_fatura f
                                JOIN cao_os o ON o.co_os = f.co_os
                                JOIN cao_usuario u ON u.co_usuario = o.co_usuario
                                JOIN cao_salario s ON u.co_usuario = s.co_usuario
                                WHERE o.co_usuario IN ('.$in.') AND
                                    MONTH(f.data_emissao) BETWEEN '.$femesde.' AND '.$femesta.' AND
                                    YEAR(f.data_emissao) BETWEEN '.$añosde.' AND '.$añosta.'
                                GROUP BY consultor, mes
                                ORDER BY consultor ASC, MONTH(f.data_emissao) ASC
                                ');




        return view('relatorio', ['consultores' => $consultores, 'consultores_aux' => $consultores_aux, 'relatorio'=>$relatorio, 'meses' => $meses, 'años' => $años]);
    }



    public function grafica(Request $request)
    {
        $meses = DB::select('SELECT DISTINCT MONTH(data_emissao) AS numero, MONTHNAME(data_emissao) AS nombre FROM cao_fatura');

        $años = DB::select('SELECT DISTINCT YEAR(data_emissao) AS años FROM cao_fatura');

        $consultores = DB::select('SELECT a.no_usuario, a.co_usuario FROM cao_usuario a
                                    JOIN permissao_sistema b ON a.co_usuario = b.co_usuario
                                    WHERE b.co_sistema = 1 AND b.in_ativo = "S" AND b.co_tipo_usuario IN (0,1,2)
                                    ORDER BY a.no_usuario ASC');
        //dd($consultores);

        //Fecha desde
        $femesde = $request->input('mesde');
        $añosde = $request->input('añosde');
        
        //Fecha hasta
        $femesta = $request->input('mesta');
        $añosta = $request->input('añosta');
        
        //opciones checkbox
        $elegidos = $request->input('elegir');
        $in = '"'.implode('","', $elegidos).'"';// VALIDAR QUE NO ESTE VACIO
        //dd($femesde, $elegidos);

        $barras = DB::select('SELECT u.no_usuario AS consultor,
                                ROUND(SUM(f.valor - (f.total_imp_inc/100)*f.valor),2) AS ganancia_neta
                            FROM cao_fatura f
                            JOIN cao_os o ON o.co_os = f.co_os
                            JOIN cao_usuario u ON u.co_usuario = o.co_usuario
                            JOIN cao_salario s ON u.co_usuario = s.co_usuario
                            WHERE o.co_usuario IN ('.$in.') AND
                                MONTH(f.data_emissao) BETWEEN '.$femesde.' AND '.$femesta.' AND
                                YEAR(f.data_emissao) BETWEEN '.$añosde.' AND '.$añosta.'
                            GROUP BY consultor
                            ORDER BY consultor ASC
                            ');

        $promedio = DB::select('SELECT CAST(SUM(s.brut_salario) / 2 AS SIGNED) AS costo_fijo_promedio
                            FROM cao_fatura f
                            JOIN cao_os o ON o.co_os = f.co_os
                            JOIN cao_usuario u ON u.co_usuario = o.co_usuario
                            JOIN cao_salario s ON u.co_usuario = s.co_usuario
                            WHERE o.co_usuario IN ('.$in.') AND
                                MONTH(f.data_emissao) BETWEEN '.$femesde.' AND '.$femesta.' AND
                                YEAR(f.data_emissao) BETWEEN '.$añosde.' AND '.$añosta.'
                            ');

        $chart = Charts::create('bar', 'highcharts')
            ->title("Grafica de desempeño")
            ->elementLabel("Ganancia")
            ->xAxisTitle("Consultores")
            ->yAxisTitle("Ganancias")
            ->legend(false)
            ->labels(collect($barras)->pluck('consultor'))
            ->values(collect($barras)->pluck('ganancia_neta'))
            ->promedio(collect($promedio)->pluck('costo_fijo_promedio')->pop());


        return view('grafica', ['consultores' => $consultores, 'meses' => $meses, 'años' => $años, 'chart' => $chart]);
    }



    public function pizza(Request $request)
    {
        $meses = DB::select('SELECT DISTINCT MONTH(data_emissao) AS numero, MONTHNAME(data_emissao) AS nombre FROM cao_fatura');

        $años = DB::select('SELECT DISTINCT YEAR(data_emissao) AS años FROM cao_fatura');

        $consultores = DB::select('SELECT a.no_usuario, a.co_usuario FROM cao_usuario a
                                    JOIN permissao_sistema b ON a.co_usuario = b.co_usuario
                                    WHERE b.co_sistema = 1 AND b.in_ativo = "S" AND b.co_tipo_usuario IN (0,1,2)
                                    ORDER BY a.no_usuario ASC');
        //dd($consultores);

        //Fecha desde
        $femesde = $request->input('mesde');
        $añosde = $request->input('añosde');
        
        //Fecha hasta
        $femesta = $request->input('mesta');
        $añosta = $request->input('añosta');
        
        //opciones checkbox
        $elegidos = $request->input('elegir');
        $in = '"'.implode('","', $elegidos).'"';// VALIDAR QUE NO ESTE VACIO
        //dd($femesde, $elegidos);

        $pizzas = DB::select('SELECT u.no_usuario AS consultor,
                                ROUND(SUM(f.valor - (f.total_imp_inc/100)*f.valor),2) AS ganancia_neta
                            FROM cao_fatura f
                            JOIN cao_os o ON o.co_os = f.co_os
                            JOIN cao_usuario u ON u.co_usuario = o.co_usuario
                            JOIN cao_salario s ON u.co_usuario = s.co_usuario
                            WHERE o.co_usuario IN ('.$in.') AND
                                MONTH(f.data_emissao) BETWEEN '.$femesde.' AND '.$femesta.' AND
                                YEAR(f.data_emissao) BETWEEN '.$añosde.' AND '.$añosta.'
                            GROUP BY consultor
                            ORDER BY consultor ASC
                            ');

        $chart = Charts::create('pie', 'highcharts')
            ->title("Porcentaje de Ganancias")
            ->labels(collect($pizzas)->pluck('consultor'))
            ->values(collect($pizzas)->pluck('ganancia_neta'));


        return view('pizza', ['consultores' => $consultores, 'meses' => $meses, 'años' => $años, 'chart' => $chart]);
    }
}
