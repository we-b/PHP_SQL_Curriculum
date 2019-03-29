<?php

use Illuminate\Database\Seeder;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use App\Shift;

class ShiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = new LexerConfig();
        $interpreter = new Interpreter();
        $interpreter->addObserver(function(array $columns) {
            Shift::create([
                "date"        => $columns[1],
                "start_time"  => $columns[2],
                "user_id"     => $columns[3],
            ]);
        });

        $lexer = new Lexer($config);
        $lexer->parse(database_path() . '/seeds/csv/shifts.csv', $interpreter);
    }
}
