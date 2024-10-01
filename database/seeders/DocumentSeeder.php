<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $people = Person::all();
        for ($i = 1; $i <= 15000; $i++) {
            $randomPerson = $people->random();
            $number = sprintf('001-001-%07d', $i);

            Document::factory()->create([
                'number' => $number,
                'person_id' => $randomPerson->id
            ]);
        }

        DB::statement("
            UPDATE documents
            SET is_primary = true
            FROM (
                SELECT person_id, MIN(id) AS first_id 
                FROM documents
                GROUP BY person_id
            ) AS subquery
            WHERE documents.id = subquery.first_id
        ");
    }
}
