<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends BaseController
{

  public function index()
  {
    $spreadsheet  = new Spreadsheet();
    $sheet        = $spreadsheet->getActiveSheet();

    // tambah data
    $sheet->setCellValue('A1', 'NIM');
    $sheet->setCellValue('B1', 'Nama');

    for ($i = 2; $i <= 10; $i++) {
      $sheet->setCellValue('A' . $i, '670114426' . $i);
      $sheet->setCellValue('B' . $i, 'Akun ke ' . $i);
    }

    // buat file excel
    $writter = new Xlsx($spreadsheet);

    // set header untuk download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . date('Y-m-d H:i:s') . '.xlsx"');
    header('Cache-Control: max-age=0');

    //tulis file ke output
    $writter->save('php://output');
    exit;
  }
}
