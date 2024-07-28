<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/Logbook', 'Logbook::index');
$routes->get('/Logbook/upload', 'Logbook::upload');
$routes->post('/Logbook/simpan', 'Logbook::simpan');
$routes->post('/Logbook/LogbookLab', 'Logbook::LogbookLab');
$routes->post('/Logbook/BAST', 'Logbook::BAST');

// begin route class Auth
$routes->get('/', 'Auth::index');
$routes->post('/Auth/login', 'Auth::login');
$routes->get('/Auth/logout', 'Auth::logout');
$routes->get('/Auth/asprak', 'Auth::asprak');
$routes->post('/Auth/registerAsprak', 'Auth::registerAsprak');
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

$routes->get('/Kalender', 'Kalender::index');
// end route class Praktikum
// end route for laboran access

// begin route for asprak access
$routes->get('/Asprak/Beranda', 'Asprak\Beranda::index');
$routes->get('/Asprak/Kehadiran', 'Asprak\Kehadiran::index');
// $routes->get('/Asprak/Kehadiran/simpanKehadiran', 'Asprak\Kehadiran::simpanKehadiran');
$routes->post('/Asprak/Kehadiran/simpanKehadiran', 'Asprak\Kehadiran::simpanKehadiran');
$routes->post('/Asprak/Kehadiran/hapusKehadiran', 'Asprak\Kehadiran::hapusKehadiran');

$routes->get('/Asprak/SuratPerjanjian', 'Asprak\SuratPerjanjian::index');
$routes->get('/Asprak/SuratPerjanjian/view', 'Asprak\SuratPerjanjian::view');

$routes->get('/Asprak/DataPribadi', 'Asprak\DataPribadi::index');
$routes->post('/Asprak/DataPribadi/simpanData', 'Asprak\DataPribadi::simpanData');

$routes->get('/Asprak/RiwayatLogin', 'Asprak\RiwayatLogin::index');
// end route for asprak access