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

    /**
     * Lista todas candidaturas
     * Endpoint GET /api/candidaturas
     */
    public function index()
    {
        if ($this->isNotAuthorized()) {
            $this->error(null, 'Acesso negado. Apenas administradores podem visualizar candidaturas.', 403);
        }
        $candidaturas = Candidatura::with(['user', 'programa'])->get();
        return ApplicationResource::collection($candidaturas);
    }

    /**
     * Cria uma nova candidatura
     * Endpoint POST /api/candidaturas
     */
    public function store(CandidaturaRequest $request)
    {
        $user = $request->user();
        $today = now()->toDateString();

        // Busca programa ou retorna erro 404
        $program = Programa::find($request->program_id);
        if (!$program) {
            return $this->error(null, 'Programa não encontrado.', 404);
        }

        // Verifica se o programa está ativo
        if ($program->status !== 'ativo') {
            return $this->error(null, 'Este programa está inativo.', 400);
        }

        // Verifica período válido
        if ($today < $program->start_date || $today > $program->end_date) {
            return $this->error(null, 'Fora do período de candidaturas.', 400);
        }

        // Impede candidaturas duplicadas
        $jaCandidatou = $user->candidaturas()
            ->where('program_id', $program->id)
            ->exists();

        if ($jaCandidatou) {
            return $this->error(null, 'Você já se candidatou a este programa.', 409);
        }

        // Cria a candidatura
        $candidatura = $user->candidaturas()->create([
            'program_id' => $program->id,
        ]);

        // Retorna formatado pelo resource
        return new ApplicationResource($candidatura->load(['user', 'programa']));
    }
}
