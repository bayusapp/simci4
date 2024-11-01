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
$routes->get('/Auth/laboran', 'Auth::laboran');
$routes->post('/Auth/submitLaboran', 'Auth::submitLaboran');
$routes->get('/Auth/asprak', 'Auth::asprak');
$routes->post('/Auth/registerAsprak', 'Auth::registerAsprak');
$routes->get('/Auth/dosen', 'Auth::dosen');
$routes->post('/Auth/registerDosen', 'Auth::registerDosen');
$routes->get('/Auth/ResetPassword', 'Auth::resetPassword');
$routes->post('/Auth/submitReset', 'Auth::submitReset');
$routes->get('/Auth/reset/(:any)', 'Auth::reset/$1');
$routes->post('/Auth/ubah', 'Auth::ubah');
$routes->post('/Auth/darkMode', 'Auth::darkMode');
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
$routes->post('/Laboratorium/generateQR', 'Laboratorium::generateQR');
$routes->post('/Laboratorium/deleteLab', 'Laboratorium::deleteLab');
// end route class Laboratorium

// begin routes class Aslab
$routes->get('/Aslab', 'Aslab::index');
// end routes class Aslab

// begin route class Praktikum
$routes->get('/Praktikum/Matakuliah', 'Praktikum::Matakuliah');
$routes->post('/Praktikum/Matakuliah', 'Praktikum::Matakuliah');
$routes->post('/Praktikum/simpanMK', 'Praktikum::simpanMK');
$routes->post('/Praktikum/updateMK', 'Praktikum::updateMK');
$routes->post('/Praktikum/deleteMK', 'Praktikum::deleteMK');

$routes->get('/Praktikum/Asprak/(:any)', 'Praktikum::Asprak/$1');
$routes->post('/Praktikum/Asprak', 'Praktikum::Asprak');
$routes->get('/Praktikum/unduhDataAsprak/(:any)', 'Praktikum::unduhDataAsprak/$1');
$routes->get('/Praktikum/DataAsprak/(:any)', 'Praktikum::DataAsprak');
$routes->post('/Praktikum/simpanAsprak', 'Praktikum::simpanAsprak');
$routes->post('/Praktikum/deleteAsprakList', 'Praktikum::deleteAsprakList');
$routes->post('/Praktikum/simpanCSVAsprak', 'Praktikum::simpanCSVAsprak');
$routes->post('/Praktikum/cekBank', 'Praktikum::cekBank');
$routes->post('/Praktikum/verifBank', 'Praktikum::verifBank');
$routes->get('/Praktikum/SuratPerjanjian/(:any)', 'Praktikum::suratPerjanjian/$1');

$routes->get('/Praktikum/BAP', 'Praktikum::BAP');
$routes->post('/Praktikum/generateBAP', 'Praktikum::generateBAP');
$routes->get('/Praktikum/LihatBAP/(:any)', 'Praktikum::LihatBAP');

$routes->get('/Praktikum/SuratTugas/', 'Praktikum::SuratTugas');

$routes->get('/Dokumen/Template', 'Dokumen::template');
$routes->post('/Dokumen/simpanDokumen', 'Dokumen::simpanDokumen');
$routes->get('/Dokumen/SuratTugasAsprak', 'Dokumen::suratTugasAsprak');
$routes->post('/Dokumen/simpanSuratTugasAsprak', 'Dokumen::simpanSuratTugasAsprak');
$routes->get('/Dokumen/LihatSuratTugas/(:any)', 'Dokumen::lihatSuratTugas/$1');
$routes->post('/Dokumen/deleteSuratTugas', 'Dokumen::deleteSuratTugas');

$routes->get('/Kalender', 'Kalender::index');
$routes->post('/Kalender/simpanCSVKalender', 'Kalender::simpanCSVKalender');

$routes->get('/TroubleTicket', 'TroubleTicket::index');
$routes->post('/TroubleTicket/simpanTroubleTicket', 'TroubleTicket::simpanTroubleTicket');
$routes->post('/TroubleTicket/progresTroubleTicket', 'TroubleTicket::progresTroubleTicket');
$routes->post('/TroubleTicket/TrackTroubleTicket', 'TroubleTicket::TrackTroubleTicket');
$routes->get('/TroubleTicket/pesanWA', 'TroubleTicket::pesanWA');
$routes->get('/TroubleTicket/test', 'TroubleTicket::test');
// end route class Praktikum
// end route for laboran access

// begin route for asprak access
$routes->get('/Asprak/Beranda', 'Asprak\Beranda::index');
$routes->get('/Asprak/Kehadiran', 'Asprak\Kehadiran::index');
// $routes->get('/Asprak/Kehadiran/simpanKehadiran', 'Asprak\Kehadiran::simpanKehadiran');
$routes->post('/Asprak/Kehadiran/simpanKehadiran', 'Asprak\Kehadiran::simpanKehadiran');
$routes->get('/Asprak/Kehadiran/EditKehadiran/(:any)', 'Asprak\Kehadiran::editKehadiran/$1');
$routes->post('/Asprak/Kehadiran/updateKehadiran', 'Asprak\Kehadiran::updateKehadiran');
$routes->post('/Asprak/Kehadiran/hapusKehadiran', 'Asprak\Kehadiran::hapusKehadiran');

$routes->get('/Asprak/SuratPerjanjian', 'Asprak\SuratPerjanjian::index');
$routes->get('/Asprak/SuratPerjanjian/view/(:any)', 'Asprak\SuratPerjanjian::view');
$routes->post('/Asprak/SuratPerjanjian/approve', 'Asprak\SuratPerjanjian::approve');

$routes->get('/Asprak/StaffLaboratorium', 'Asprak\StaffLaboratorium::index');

$routes->get('/Asprak/DataPribadi', 'Asprak\DataPribadi::index');
$routes->post('/Asprak/DataPribadi/simpanData', 'Asprak\DataPribadi::simpanData');

$routes->get('/Asprak/RiwayatLogin', 'Asprak\RiwayatLogin::index');
// end route for asprak access

// begin route for dosen access
$routes->get('/Dosen/Beranda', 'Dosen\Beranda::index');

$routes->get('/Dosen/Kehadiran', 'Dosen\Kehadiran::index');
$routes->post('/Dosen/Kehadiran/approve', 'Dosen\Kehadiran::approve');
$routes->post('/Dosen/Kehadiran/reject', 'Dosen\Kehadiran::reject');
// end route for dosen access


$routes->get('/Tracking/(:any)', 'Tracking::index');


$routes->get('/Ticketing', 'Ticketing::index');

$routes->get('/Validasi', 'Validasi::index');

$routes->get('/Excel', 'Excel::index');

// Restful API
$routes->resource('Aslab_API');
