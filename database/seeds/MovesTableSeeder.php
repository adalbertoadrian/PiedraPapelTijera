<?php

use Illuminate\Database\Seeder;

class MovesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('moves')->insert([
            [
                'move' => 'paper',
                'kills' => 'rock',
                'created_at' => 'NOW()',
                'updated_at' => 'NOW()'
            ],
            [
                'move' => 'rock',
                'kills' => 'scissors',
                'created_at' => 'NOW()',
                'updated_at' => 'NOW()'
            ],
            [
                'move' => 'scissors',
                'kills' => 'paper',
                'created_at' => 'NOW()',
                'updated_at' => 'NOW()'
            ]
        ]);
    }
}
