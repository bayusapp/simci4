<?php

namespace App\Controllers;

use App\Libraries\MpdfLibrary;
use App\Models\M_Asprak;
use App\Models\M_Asprak_List;
use App\Models\M_Dosen;
use App\Models\M_Laboran;
use App\Models\M_Matakuliah;
use App\Models\M_Matakuliah_Semester;
use App\Models\M_Prodi;
use App\Models\M_Tahun_Ajaran;

// use App\Libraries\MpdfLibrary;
// use App\Libraries\MpdfLibrary;

// use Dompdf\Dompdf;

use App\Libraries\Pdfgenerator;
use App\Models\M_BAP_Asprak;
use App\Models\M_BAP_Asprak_Kehadiran;
use App\Models\M_Honor_Jam;

class Praktikum extends BaseController
{

  var $data;
  protected $asprak;
  protected $asprak_list;
  protected $bap_asprak;
  protected $bap_asprak_kehadiran;
  protected $dosen;
  protected $honor_jam;
  protected $laboran;
  protected $mk;
  protected $mk_semester;
  protected $prodi;
  protected $ta;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2') {
        $this->asprak       = new M_Asprak();
        $this->asprak_list  = new M_Asprak_List();
        $this->bap_asprak           = new M_BAP_Asprak();
        $this->bap_asprak_kehadiran = new M_BAP_Asprak_Kehadiran();
        $this->dosen        = new M_Dosen();
        $this->honor_jam    = new M_Honor_Jam();
        $this->laboran      = new M_Laboran();
        $this->prodi        = new M_Prodi();
        $this->mk           = new M_Matakuliah();
        $this->mk_semester  = new M_Matakuliah_Semester();
        $this->ta           = new M_Tahun_Ajaran();
        $nip                = session()->get('nip_laboran');
        $data_laboran       = $this->laboran->getDataLaboran($nip);
        $this->data         = array(
          'nip_laboran'   => $data_laboran['nip_laboran'],
          'nama_laboran'  => $data_laboran['nama_laboran'],
          'foto_laboran'  => $data_laboran['foto_laboran']
        );
      } else {
        header("Location: " . base_url());
        die();
      }
    }
  }

  public function Matakuliah()
  {
    $data = $this->data;
    if (!$this->validate([
      'tahun_ajaran'  => ['rules' => 'required']
    ])) {
      $data['tahun_aktif']  = $this->ta->getTahunAjaran()['id_ta'];
    } else {
      $data['tahun_aktif']  = $this->request->getPost('tahun_ajaran');
    }
    $data['dosen']      = $this->dosen->getDataDosen();
    $data['matakuliah'] = $this->mk->getDataMKAll();
    $data['prodi']      = $this->prodi->getDataProdi();
    $data['ta']         = $this->ta->getAllTahunAjaran();
    return view('laboran/praktikum/v_matakuliah', $data);
  }

  public function simpanMK()
  {
    if (!$this->validate([
      'kode_mk'     => ['rules' => 'required'],
      'id_ta'       => ['rules' => 'required'],
      'kode_dosen'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $kode_mk    = $this->request->getPost('kode_mk');
      $id_ta      = $this->request->getPost('id_ta');
      $kode_dosen = $this->request->getPost('kode_dosen');
      $cek_data   = $this->mk_semester->checkDataMKSemester($kode_mk, $id_ta);
      if ($cek_data) {
        session()->setFlashdata('error', 'Data Mata Kuliah Semester ' . $kode_mk . ' Sudah Ada');
        return redirect()->back()->withInput();
      } else {
        $input    = [
          'kode_mk'     => $kode_mk,
          'id_ta'       => $id_ta,
          'kode_dosen'  => $kode_dosen
        ];
        $this->mk_semester->insert($input);
        session()->setFlashdata('sukses', 'Data Mata Kuliah Sukses Ditambahkan');
        return redirect()->back();
      }
    }
  }

  public function updateMK()
  {
    if (!$this->validate([
      'id_mk_semester'  => ['rules' => 'required'],
      'kode_mk'         => ['rules' => 'required'],
      'id_ta'           => ['rules' => 'required'],
      'kode_dosen'      => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $id_mk_semester = $this->request->getPost('id_mk_semester');
      $kode_mk        = $this->request->getPost('kode_mk');
      $id_ta          = $this->request->getPost('id_ta');
      $kode_dosen     = $this->request->getPost('kode_dosen');
      $cek_data       = $this->mk_semester->checkDataMKSemesterUpdate($id_mk_semester, $kode_mk, $id_ta, $kode_dosen);
      if ($cek_data) {
        session()->setFlashdata('error', 'Data Mata Kuliah Semester ' . $kode_mk . ' Sudah Ada');
        return redirect()->back()->withInput();
      } else {
        $this->mk_semester->updateDataMKSemester($id_mk_semester, $kode_mk, $id_ta, $kode_dosen);
        session()->setFlashdata('sukses', 'Data Mata Kuliah Sukses Diperbarui');
        return redirect()->back();
      }
    }
  }

  public function deleteMK()
  {
    if (!$this->validate([
      'id' => ['rules' => 'required']
    ])) {
      return redirect()->to('Beranda');
    } else {
      $id_mk_semester = $this->request->getPost('id');
      $this->mk_semester->deleteDataMKSemester($id_mk_semester);
    }
  }

  public function Asprak()
  {
    $data = $this->data;
    if (!$this->validate([
      'tahun_ajaran'  => ['rules' => 'required']
    ])) {
      $data['tahun_aktif']  = $this->ta->getTahunAjaran()['id_ta'];
    } else {
      $data['tahun_aktif']  = $this->request->getPost('tahun_ajaran');
    }
    $data['matkul'] = $this->mk_semester->getDataMKSemesterAktif();
    $data['prodi']  = $this->prodi->getDataProdi();
    $data['ta']     = $this->ta->getAllTahunAjaran();
    return view('laboran/praktikum/v_asprak', $data);
  }

  public function simpanCSVAsprak()
  {
    $ta_aktif       = $this->ta->getTahunAjaran()['id_ta'];
    $file           = $_FILES['file_csv']['tmp_name'];
    $ekstensi_file  = explode('.', $_FILES['file_csv']['name']);
    if (strtolower(end($ekstensi_file)) === 'csv' && $_FILES['file_csv']['size'] > 0) {
      $handle = fopen($file, 'r');
      $i      = 0;
      while ($row = fgetcsv($handle, 2048, ';')) {
        $i++;
        if ($i == 1) {
          continue;
        }
        $nim      = $row[0];
        $nama     = $row[1];
        $kode_mk  = $row[2];
        $input    = [
          'nim_asprak'  => $nim,
          'nama_asprak' => $nama
        ];
        $cek_asprak = $this->asprak->checkDataAsprak($nim);
        if (!$cek_asprak) {
          $this->asprak->insert($input);
        }
        $id_mk_semester = $this->mk_semester->checkDataMKSemester($kode_mk, $ta_aktif)['id_mk_semester'];
        $input_list = [
          'nim_asprak'      => $nim,
          'id_mk_semester'  => $id_mk_semester
        ];
        $cek_asprak_list  = $this->asprak_list->checkDataAsprakList($nim, $id_mk_semester);
        if (!$cek_asprak_list) {
          $this->asprak_list->insert($input_list);
        }
      }
      session()->setFlashdata('sukses', 'Data Asisten Praktikum Sukses Ditambahkan');
      return redirect()->back();
    }
  }

  public function cekBank()
  {
    if (!$this->validate([
      'id' => ['rules' => 'required']
    ])) {
      return redirect()->to('Beranda');
    } else {
      $id         = $this->request->getPost('id');
      $split_bank = explode('/', $id);
      $kode_bank  = $split_bank[0];
      $norek_bank = $split_bank[1];
      $ambil_data = file_get_contents("https://api-rekening.lfourr.com/getBankAccount?bankCode={$kode_bank}&accountNumber={$norek_bank}");
      $convert_data = json_decode($ambil_data);
      return 'Rekening a.n. ' . $convert_data->data->accountname . ', Nomor Rekening ' . $convert_data->data->accountnumber . ' pada ' . $convert_data->data->bankname;
    }
  }

  public function verifBank()
  {
    if (!$this->validate([
      'id' => ['rules' => 'required']
    ])) {
      return redirect()->to('Beranda');
    } else {
      $id           = $this->request->getPost('id');
      $nim_asprak   = $this->asprak_list->validateBank($id)['nim_asprak'];
      $nip_laboran  = session()->get('nip_laboran');
      $this->asprak->validateBank($nim_asprak, $nip_laboran);
      return 'sukses';
    }
  }

  public function BAP()
  {
    $data = $this->data;
    if (!$this->validate([
      'tahun_ajaran'  => ['rules' => 'required']
    ])) {
      $data['tahun_aktif']  = $this->ta->getTahunAjaran()['id_ta'];
    } else {
      $data['tahun_aktif']  = $this->request->getPost('tahun_ajaran');
    }
    $data['matakuliah'] = $this->mk->getDataMKAll();
    $data['prodi']  = $this->prodi->getDataProdi();
    $data['ta']     = $this->ta->getAllTahunAjaran();
    return view('laboran/praktikum/v_bap', $data);
  }

  public function generateBAP()
  {
    if (!$this->validate([
      'kode_mk'         => ['rules' => 'required'],
      'dari_tanggal'    => ['rules' => 'required'],
      'sampai_tanggal'  => ['rules' => 'required']
    ])) {
      return redirect(base_url('Praktikum/BAP'));
    } else {
      $kode_mk          = $this->request->getPost('kode_mk');
      $tanggal_awal     = convertDatePicker($this->request->getPost('dari_tanggal'));
      $tanggal_akhir    = convertDatePicker($this->request->getPost('sampai_tanggal'));
      $bulan            = bulanIndoPanjang(date('m'));
      $tahun            = date('Y');
      $tanggal_generate = date('Y-m-d');
      $tahun_ajaran     = $this->ta->getTahunAjaran()['id_ta'];
      $id_mk_semester   = $this->mk_semester->checkDataMKSemester($kode_mk, $tahun_ajaran)['id_mk_semester'];
      $id_prodi         = $this->mk->getProdiByKodeMK($kode_mk)['id_prodi'];
      $id_honor         = $this->honor_jam->getHonorActive()['id_honor'];
      $get_asprak_list  = $this->asprak_list->getAsprakByIdMkSemester($id_mk_semester);
      $jumlah_jam       = 0;
      foreach ($get_asprak_list as $g) {
        $nim_asprak     = $g['nim_asprak'];
        $id_asprak_list = $g['id_asprak_list'];
        $get_data_kehadiran = $this->bap_asprak_kehadiran->generateBAP($id_asprak_list, $tanggal_awal, $tanggal_akhir);
        if ($get_data_kehadiran) {
          $jumlah_jam = 0;
          foreach ($get_data_kehadiran as $k) {
            $jumlah_jam = $jumlah_jam + $k['jumlah_jam'];
          }
          $input = [
            'bulan'             => $bulan,
            'tahun'             => $tahun,
            'jumlah_jam'        => $jumlah_jam,
            'tanggal_awal'      => $tanggal_awal,
            'tanggal_akhir'     => $tanggal_akhir,
            'tanggal_generate'  => $tanggal_generate,
            'nim_asprak'        => $nim_asprak,
            'id_prodi'          => $id_prodi,
            'kode_mk'           => $kode_mk
          ];
          $this->bap_asprak->insert($input);
          $id_bap = $this->bap_asprak->getIdBAP($bulan, $tahun, $jumlah_jam, $tanggal_awal, $tanggal_akhir, $tanggal_generate, $nim_asprak, $id_prodi, $kode_mk)['id_bap'];
          $this->bap_asprak_kehadiran->updateIdBAPnHonor($tanggal_awal, $tanggal_akhir, $id_asprak_list, $id_bap, $id_honor);
        }
      }
      session()->setFlashdata('sukses', 'BAP Asisten Praktikum Sukses Digenerate');
      return redirect()->back();
    }
  }

  public function LihatBAP()
  {
    $id  = $this->request->getUri()->getSegment(3);
    $cek_bap = $this->bap_asprak->getDataBAPById($id);
    if ($cek_bap) {
      $kode_mk            = $cek_bap['kode_mk'];
      $id_bap             = $this->bap_asprak->getDataBAPById($id)['id_bap'];
      $data['mk']         = $this->mk->getProdiByKodeMK($kode_mk);
      $data['mk_bap']     = $this->bap_asprak->getDataBAPById($id);
      $data['kehadiran']  = $this->bap_asprak_kehadiran->getDataBAPByIdBAP($id_bap);
      $data['koor']       = $this->mk_semester->getDataKoordinatorMK($kode_mk)['nama_dosen'];
      return view('laboran/praktikum/v_format_bap', $data);
    } else {
      return redirect()->to('Praktikum/BAP');
    }
  }

  public function GenerateSuratTugas()
  {
    $id_prodi = '6';
  }

  public function SuratTugas()
  {
    $id_dsta = '1';
    // $data['surat_tugas']
    // return view('laboran/praktikum/v_surat_tugas_asprak');
  }

  public function SP()
  {
    return view('asprak/v_surat_perjanjian');
  }
}
