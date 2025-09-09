<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'submitted' => $this->created_at->format('Y-m-d H:i:s'),
            // Relacionamento
            'candidato' => [
                'id'    => $this->user->id,
                'name'  => $this->user->name,
                'email' => $this->user->email
            ],
            // programa
            'programa'  => [
                'id'    => $this->programa->id,
                'title' => $this->programa->title,
                'status'=> $this->programa->status,
                'dates' => [
                    'start' => $this->programa->start_date,
                    'end'   => $this->programa->end_date,
                ],
            ]
        ];
    }
}
