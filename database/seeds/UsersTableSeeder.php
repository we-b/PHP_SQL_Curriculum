<?php

use Illuminate\Database\Seeder;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use App\User;

class UsersTableSeeder extends Seeder
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
            User::create([
                "family_name" => $columns[1],
                "first_name"  => $columns[2],
                "age"         => $columns[3],
                "prefecture"  => $columns[4],
            ]);
        });

        $lexer = new Lexer($config);
        $lexer->parse(database_path() . '/seeds/csv/users.csv', $interpreter);
    }
}
