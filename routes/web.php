<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/blog', function () {
//     // $a = 2;
//     // $b = 3;
//     // $c =  $a + $b;
//     // return 'Hasil dari variabel $c adalah' . $c;

//     $profil = 'aku adlaah programmer pro';
//     return view('blog', ['data' => $profil]);
// })->name('blog');

Route::get('/blog', [BlogController::class, 'index']);

// Jika ingin mengakses children in the route
Route::get('/blog/{id}', function (Request $request) {
    // $name = $request->name;
    // $password = $request->password;

    // Anggap saja melakukan update data & berhasil
    return redirect()->route('blog');

    $id = $request->route('id'); // Mengambil parameter 'id' dari route
    return 'ini adalah blog ' . $id;
});

// Jika ingin menggunakan Route View
// Route::view('/blog', 'blog', ['data' => 'test 123 saaya']);
