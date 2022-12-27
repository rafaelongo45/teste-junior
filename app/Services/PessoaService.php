<?php

namespace App\Services;


use App\Repositories\PessoaRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Entities\Pessoa;

class PessoaService implements PessoaServiceInterface
{
    /**
     * @var PessoaRepository
     */
    private $pessoaRepo;
    private $parametersArray;
    public function __construct(PessoaRepository $pessoaRepository)
    {
        $this->pessoaRepo = $pessoaRepository;
        $this->parametersArray = ['id', 'nome', 'sobrenome','celular', 'cpf', 'cep', 'logradouro'];
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?Model
    {
        return $this->pessoaRepo->find($id, $this->parametersArray);
    }

    public function findByCPF(string $cpf): ?Model
    {
        return Pessoa::where('cpf', $cpf)->first();
    }

    /**
     * @inheritDoc
     */
    public function all(): ?Collection
    {
        return $this->pessoaRepo->all($this->parametersArray);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): ?Model
    {
        return $this->pessoaRepo->create($data);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): ?bool
    {
        return $this->pessoaRepo->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function update(array $data, int $id): ?Model
    {
        $pessoa = $this->find($id);
        $keys = array_keys($data);
        foreach($keys as $key){
            $pessoa->$key = $data[$key];
            $pessoa->save();
        }
        return $pessoa;
    }
}
