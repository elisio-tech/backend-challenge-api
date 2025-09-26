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

    public function index()
    {
        $programs = Programa::all();
        return ProgramResource::collection($programs);
    }

 
    public function show(string $id)
    {
        $program = Programa::find($id);
       
        if (!$program) {
            return $this->error(null, 'Programa não encontrado', 404);
	}

        return new ProgramResource($program);
    }

    private function isNotAuthorized(): bool
    {
        return Auth::user()->role !== 'admin'; 
    }

    public function store(ProgramRequest $request)
    {
        if ($this->isNotAuthorized()) {
            return $this->error(null, 'Você não está autorizado', 403);
        }

        $program = Programa::create($request->validated());
        return new ProgramResource($program);
    }

    public function update(UpdateProgramRequest $request, string $id)
    {
        $program = Programa::find($id);

        if ($this->isNotAuthorized()) {
            return $this->error(null, 'Você não está autorizado', 403);
        }

        if (!$program) {
            return $this->error(null, 'Programa não encontrado', 404);
        }

        $program->update($request->validated());
        return $this->success($program, 'Programa atualizado sucesso', 200);
    }

    public function destroy(string $id)
    {
        $program = Programa::find($id);
          
        if ($this->isNotAuthorized()) {
            return $this->error(null, 'Você não está autorizado', 403);
        }

        if (!$program) {
            return $this->error(null, 'Programa não encontrado', 404);
        }

        $program->delete();
        return $this->success(null, 'Programa deletado com sucesso', 200);
    }
}
