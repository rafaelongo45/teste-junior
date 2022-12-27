<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PessoaStoreRequest;
use App\Http\Requests\PessoaUpdateRequest;
use App\Services\PessoaServiceInterface;
use App\Services\PessoaService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PessoaController extends Controller
{
    /**
     * @var PessoaServiceInterface
     */
    private $pessoaService;
    private $parametersArray;
    private $validateArray;

    public function __construct(PessoaService $pessoaService)
    {
        $this->pessoaService = $pessoaService;        
        $this->parametersArray = ['id', 'nome', 'sobrenome','celular', 'cpf', 'cep', 'logradouro'];
        $this->validateArray = [
            'nome' => 'required',
            'sobrenome' => 'required',
            'cep' => 'required',
            'cpf' => 'required|size:11|regex:/^[0-9]{11}$/',
            'logradouro' => 'required',
            'celular' => 'required'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoa = $this->pessoaService->all();
        return response()->json($pessoa, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PessoaStoreRequest $request)
    {
        $request->validate($this->validateArray);

        $pessoaDb = $this->pessoaService->findByCPF($request['cpf']);
    
        if ($pessoaDb) {
            return response()->json("User with this CPF is already registered", Response::HTTP_CONFLICT);
        }

        $pessoa = $this->pessoaService->create($request->all());
        return response()->json($pessoa->only($this->parametersArray), Response::HTTP_CREATED);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $pessoa = $this->pessoaService->find($id);
        if (!$pessoa) {
            return response()->json("There isn't a person registered with this id", Response::HTTP_NOT_FOUND);
        }
        return response()->json($pessoa, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaUpdateRequest $request, $id)
    {
        //
        $request->validate($this->validateArray);

        $pessoa = $this->pessoaService->find($id);

        $data = $request->only($this->parametersArray);
        $this->pessoaService->update($data, $id);
        return response()->json('Data updated successfully', Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->pessoaService->delete($id);
        return response()->json("Data removed from database", Response::HTTP_OK);
    }
}
