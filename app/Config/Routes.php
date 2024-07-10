<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// begin route class Auth
$routes->get('/', 'Auth::index');
$routes->post('/Auth/login', 'Auth::login');
$routes->get('/Auth/logout', 'Auth::logout');
// end route class Auth

// begin route for laboran access
// begin route class Beranda
$routes->get('/Beranda', 'Beranda::index');
// end route class Beranda

// begin route class DataMaster
$routes->get('/DataMaster/ProgramStudi', 'DataMaster::ProgramStudi');
$routes->post('/DataMaster/simpanProdi', 'DataMaster::simpanProdi');
$routes->post('/DataMaster/updateProdi', 'DataMaster::updateProdi');
$routes->post('/DataMaster/deleteProdi', 'DataMaster::deleteProdi');

$routes->get('/DataMaster/Dosen', 'DataMaster::Dosen');
$routes->post('/DataMaster/simpanDosen', 'DataMaster::simpanDosen');
$routes->post('/DataMaster/updateDosen', 'DataMaster::updateDosen');
$routes->post('/DataMaster/deleteDosen', 'DataMaster::deleteDosen');
$routes->get('/DataMaster/csvDosen', 'DataMaster::csvDosen');
$routes->post('/DataMaster/simpanCSVDosen', 'DataMaster::simpanCSVDosen');

$routes->get('/DataMaster/MataKuliah', 'DataMaster::MataKuliah');
$routes->post('/DataMaster/simpanMK', 'DataMaster::simpanMK');
$routes->post('/DataMaster/updateMK', 'DataMaster::updateMK');
$routes->post('/DataMaster/deleteMK', 'DataMaster::deleteMK');
$routes->get('/DataMaster/csvMK', 'DataMaster::csvMK');
$routes->post('/DataMaster/simpanCSVMK', 'DataMaster::simpanCSVMK');

$routes->get('/DataMaster/Laboran', 'DataMaster::Laboran');
$routes->post('/DataMaster/simpanLaboran', 'DataMaster::simpanLaboran');
$routes->post('/DataMaster/updateLaboran', 'DataMaster::updateLaboran');
$routes->post('/DataMaster/deleteLaboran', 'DataMaster::deleteLaboran');
// end route class DataMaster

// begin route class Laboratorium
$routes->get('/Laboratorium', 'Laboratorium::index');
$routes->post('/Laboratorium/simpanLab', 'Laboratorium::simpanLab');
$routes->post('/Laboratorium/updateLab', 'Laboratorium::updateLab');
$routes->post('/Laboratorium/deleteLab', 'Laboratorium::deleteLab');
// end route class Laboratorium

// begin route class Praktikum
$routes->get('/Praktikum/Matakuliah', 'Praktikum::Matakuliah');
$routes->post('/Praktikum/Matakuliah', 'Praktikum::Matakuliah');
$routes->post('/Praktikum/simpanMK', 'Praktikum::simpanMK');
$routes->post('/Praktikum/updateMK', 'Praktikum::updateMK');
$routes->post('/Praktikum/deleteMK', 'Praktikum::deleteMK');

$routes->get('/Praktikum/Asprak', 'Praktikum::Asprak');
$routes->post('/Praktikum/Asprak', 'Praktikum::Asprak');
$routes->post('/Praktikum/simpanCSVAsprak', 'Praktikum::simpanCSVAsprak');
$routes->post('/Praktikum/cekBank', 'Praktikum::cekBank');
$routes->post('/Praktikum/verifBank', 'Praktikum::verifBank');
// end route class Praktikum
// end route for laboran access