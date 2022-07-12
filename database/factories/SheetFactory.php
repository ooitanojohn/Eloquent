<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sheet;

class SheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
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
        return [
            $sheets
        ];
    }
}
