<?php

namespace Database\Seeders;

use App\Models\Programa;
use Illuminate\Database\Seeder;

class ProgramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programas = [
            [
                'title'      => 'Bootcamp Laravel',
                'status'     => 'ativo',
                'start_date' => '2025-09-01',
                'end_date'   => '2025-09-30',
            ],
            [
                'title'      => 'Formação Vue.js',
                'status'     => 'ativo',
                'start_date' => '2025-09-01', 
                'end_date'   => '2025-11-20',
            ],
            [
                'title'      => 'Next.js Intensivo',
                'status'     => 'ativo', 
                'start_date' => '2025-09-05',
                'end_date'   => '2025-10-25',
            ],
            [
                'title'      => 'Curso Fullstack PHP',
                'status'     => 'ativo',
                'start_date' => '2025-09-01', 
                'end_date'   => '2025-09-18',
            ],
            [
                'title'      => 'Java Backend Training',
                'status'     => 'ativo',
                'start_date' => '2026-01-05',
                'end_date'   => '2026-02-05',
            ],
            [
                'title'      => 'Python Data Science',
                'status'     => 'ativo',
                'start_date' => '2026-03-01',
                'end_date'   => '2026-03-30',
            ],
            [
                'title'      => 'React Avançado',
                'status'     => 'ativo',
                'start_date' => '2026-04-01',
                'end_date'   => '2026-04-30',
            ],
            [
                'title'      => 'DevOps Essentials',
                'status'     => 'inativo',
                'start_date' => '2026-05-01',
                'end_date'   => '2026-05-20',
            ],
            [
                'title'      => 'Machine Learning Bootcamp',
                'status'     => 'ativo',
                'start_date' => '2026-06-01',
                'end_date'   => '2026-06-30',
            ],
            [
                'title'      => 'Cloud Computing AWS',
                'status'     => 'ativo',
                'start_date' => '2026-07-01',
                'end_date'   => '2026-07-31',
            ],
        ];

        foreach ($programas as $programa) {
            Programa::create($programa);
        }
    }
}
