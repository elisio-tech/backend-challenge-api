<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Http\Resources\ProgramResource;
use App\Models\Programa;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    use HttpResponses;

    /**
     * Retorna todos os programas cadastrados.
     * GET /programas
    */
    public function index()
    {
        $programs = Programa::all();
        return ProgramResource::collection($programs);
    }

    /**
     * Retorna um unico programa pelo id
     * GET /programa/{id}
    */
    public function show(string $id)
    {
        $program = Programa::find($id);
        // caso nao encontre o programa
        if (!$program) {
            return $this->error(null, 'Programa não encontrado', 404);
        }
        return new ProgramResource($program);
    }

    /**
     * Verifica se o usuário atual não é admin.
     * Retorna true se não for autorizado.
    */
    private function isNotAuthorized(): bool
    {
        return Auth::user()->role !== 'admin'; 
    }

    /**
     * Cria um novo programa.
     * POST /novo-programa
     * Apenas admins tem a permissão.
    */
    public function store(ProgramRequest $request)
    {
        if ($this->isNotAuthorized()) {
            return $this->error(null, 'Você não está autorizado', 403);
        }

        // Criar novo programa 
        try {
            $program = Programa::create($request->validated());
            return new ProgramResource($program); // retorna novo programa
        } catch (\Exception $e) {
            return $this->error(null, 'Não foi possível criar o programa. Tente novamente.', 500);
        }
    }

    /** 
     * Atualiza um programa pelo ID
     * POST /programa/{id}
     * Apenas admins tem permissão. 
    */
    public function update(UpdateProgramRequest $request, string $id)
    {
        $program = Programa::find($id);

        if ($this->isNotAuthorized()) {
            return $this->error(null, 'Você não está autorizado', 403);
        }

        if (!$program) {
            return $this->error(null, 'Programa não encontrado', 404);
        }

        // Atualiza o programa
        try {
            $program->update($request->validated());
            return $this->success($program, 'Programa atualizado sucesso', 200);
        } catch (\Exception $e) {
            return $this->error(null, 'Não foi possível atualizar o programa.', 500);
        }
    }

    /**
     * Deleta um programa pelo ID.
     * DELETE /programa/{id}
     * Somente admins podem deletar.
    */
    public function destroy(string $id)
    {
        $program = Programa::find($id);
        // verifica a autorizacao    
        if ($this->isNotAuthorized()) {
            return $this->error(null, 'Você não está autorizado', 403);
        }

        // Caso não encontrar
        if (!$program) {
            return $this->error(null, 'Programa não encontrado', 404);
        }

        try {
            $program->delete();
            return $this->success(null, 'Programa deletado com sucesso', 200);
        } catch (\Exception $e) {
            return $this->error(null, 'Não foi possível deletar o programa. Tente novamente.', 500);
        }
    }
}
