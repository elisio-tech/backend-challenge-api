<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidaturaRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Candidatura;
use App\Models\Programa;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    use HttpResponses;

    private function isNotAuthorized(): bool
    {
        return Auth::user()->role !== 'admin';
    }

    public function index()
    {
        if ($this->isNotAuthorized()) {
            $this->error(null, 'Acesso negado. Apenas administradores podem visualizar candidaturas.', 403);
	}

        $applications = Candidatura::with(['user', 'programa'])->get();
        return ApplicationResource::collection($applications);
    }

  
    public function store(CandidaturaRequest $request)
    {
        $user = $request->user();
        $today = now()->toDateString();

	$program = Programa::find($request->program_id);

        if (!$program) {
            return $this->error(null, 'Programa não encontrado.', 404);
        }

        if ($program->status !== 'ativo') {
            return $this->error(null, 'Este programa está inativo.', 400);
        }

        // Verifica período válido
        if ($today < $program->start_date || $today > $program->end_date) {
            return $this->error(null, 'Fora do período de candidaturas.', 400);
	}

        // Evita candidaturas duplicadas
        $hasApplied = $user->candidaturas()
            ->where('program_id', $program->id)
            ->exists();

        if ($hasApplied) {
            return $this->error(null, 'Você já se candidatou a este programa.', 409);
        }

        $apply = $user->candidaturas()->create(['program_id' => $program->id,]);
        return new ApplicationResource($apply->load(['user', 'programa']));
    }
}
