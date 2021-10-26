<?php

namespace App\Models;

class Note
{
    static  $note = [
        [
            'id' => 1,
            'nama' => 'Rapat 1',
            'tanggal' => '10-10-2021',
            'pembuat' => 'Adam Wiguna',
            'isi' => [
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, qui.',
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, qui.',
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, qui.',
            ]
        ],
        [
            'id' => 2,
            'nama' => 'Rapat 2',
            'tanggal' => '11-10-2021',
            'pembuat' => 'Adam',
            'isi' => [
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, qui.',
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, qui.',
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, qui.',
            ]
        ],
        [
            'id' => 3,
            'nama' => 'Rapat 3',
            'tanggal' => '11-10-2021',
            'pembuat' => 'Wiguna',
            'isi' => [
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, qui.',
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, qui.',
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, qui.',
            ]
        ],
    ];

    public static function all()
    {
        return collect(self::$note);
    }

    public static function find($id)
    {
        // $notes = self::$note;
        $notes = static::all();
        // $not = [];
        // foreach ($notes as $n ) {
        //     if ($n['id'] == $id) {
        //        $not = $n;
        //     }
        // }
        return $notes->firstWhere('id',$id);
    }
}
