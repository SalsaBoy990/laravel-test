<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Diós süti' => 'primary', // blue
            'Almás süti' => 'secondary', // grey
            'Mákos süti' => 'warning', // yellow
            'Túrós süti' => 'success', // green
            'Sütőtökös süti' => 'light', // white grey
            'Torta' => 'info', // turquoise
            'Palacsinta' => 'danger', // red
            'Bejgli' => 'dark' // black-white
        ];

        foreach ($tags as $key => $value) {
            $tag = new Tag(
                [
                    'name' => $key,
                    'style' => $value,
                    'slug' => Str::slug($key, '-'),
                ]
            );
            $tag->save();
        }
    }
}
