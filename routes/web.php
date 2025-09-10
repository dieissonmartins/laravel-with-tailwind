<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste-abas', function () {
    return view('teste-abas');
});

Route::get('/clientes', function () {
    return "<p>Esta é a página de clientes.</p>";
});

Route::get('/produtos', function () {
    return "<p>Esta é a página de produtos.</p>";
});

Route::get('/vendas', function () {
    return "<p>Esta é a página de vendas.</p>";
});
