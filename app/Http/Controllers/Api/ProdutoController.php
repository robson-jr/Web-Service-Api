<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Http\Resources\ProdutoResource;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->input('pagina');

        $query = Produto::with('categoria');

        if($input){
            $page = $input;
            $perPage = 10;
            $query->offset (($page - 1) * $perPage)->limit($perPage);
            $produtos = $query->get();

            $recordsTotal = Produto::count();
            $numberOfPages = ceil($recordsTotal / $perPage);
            $response = response()-> json([
                'status' => 200,
                'mensagem' => 'Lista retornada',
                'produtos' => ProdutoResource::collection($produtos),
                'meta' => [
                    'total_numero_de_registros' => (string) $recordsTotal,
                    'numero_de_paginas' => (string) $numberOfPages,
                    'pagina_total' => $page
                ]
            ],200);
        }else{
            $produtos = $query->get();

            $response = response() -> json([
                'status' => 200,
                'mensagem' => 'Lista de produtos retornada',
                'produtos' => ProdutoResource::collection($produtos)
            ],200);
        }
        /*$query = Produto::with('categoria');

        $filterParameter = $request->input('filtro');

        if($filterParameter == null){

            $produtos = $query->get();

            $response = response()->json([
                'status' => 200,
                'mensagem' => 'Lista de produtos retornada',
                'produtos' => ProdutoResource::collection($produtos)
            ],200);
        }else{
            [$filterCriteria, $filterValue] = explode(":",$filterParameter);

            if($filterCriteria == "nome_da_categoria"){
                $produtos = $query->join("categorias","pkcategoria","=","fkcategoria")->where("nomedacategoria","=",$filterValue)->get();

                $response = response()->json([
                    'status' => 200,
                    'mensagem' => 'Lista de produtos retornada - Filtrada',
                    'produtos' => ProdutoResource::collection($produtos)
                ],200);
            }else{
                $response = response()->json([
                    'status' => 406,
                    'mensagem' => 'Filtro não aceito',
                    'produtos' => []
                ],406);
            }*/
        return ($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
