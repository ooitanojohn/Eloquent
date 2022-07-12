<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// add
use App\Models\Sheet;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Arr;

class SheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // sheets 削除
        DB::table('sheets')->truncate();
        // \App\Models\Sheet::factory(3)->create();
        $sheets = [];
        for ($screen = 1; $screen <= 3; $screen++) {
            for ($row = 1; $row <= 3; $row++) {
                for ($column = 1; $column <= 5; $column++) {
                    switch ($row) {
                        case 1:
                            $row_string = 'a';
                            break;
                        case 2:
                            $row_string =  'b';
                            break;
                        case 3:
                            $row_string =  'c';
                            break;
                    }
                    $sheets[] = [
                        'column' => $column,
                        'row' => $row_string,
                        'screen_id' => $screen,
                    ];
                }
            }
        }
        // insert
        foreach ($sheets as $sheet) {
            DB::table('sheets')->insert([$sheet]);
        }
    }
}
