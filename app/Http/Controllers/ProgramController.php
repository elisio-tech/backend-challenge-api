<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramRequest;
use App\Http\Resources\ProgramResource;
use App\Models\Programa;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    use HttpResponses;

    public function index()
    {
        $programs = Programa::all();
        return ProgramResource::collection($programs);
    }

    public function store(ProgramRequest $request)
    {
        $program = Programa::create($request->validated());
        // Retorna o novo programa 
        return new ProgramResource($program);
    }

    public function show(string $id)
    {
        $program = Programa::find($id);

        if (!$program) {
            return $this->error(null, 'Programa não encontrado', 404);
        }
        return new ProgramResource($program);
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    // Checar previlegios
    private function isNotAuthorized(): bool
    {
        // retorna true ou false
        return Auth::user()->role !== 'admin';
    }

    // Metodo para deletar um programa
    public function destroy(string $id)
    {
        $program = Programa::find($id);
        // verifica a autorizacao    
        if ($this->isNotAuthorized()) {
            return $this->error(null, 'Você não está autorizado', 403);;
        }

        if(!$program)
        {
            return $this->error(null, 'Programa não encontrado', 404);
        }
        
        try{
            $program->delete();
            return $this->success(null, 'Programa deletado com sucesso', 200);
        }catch(\Exception $e){
            return $this->error(null, 'Não foi possível deletar o programa. Tente novamente.', 500);
        }
    }
}
