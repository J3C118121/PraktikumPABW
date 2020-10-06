<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Mahasiswa\Coba;
use Illuminate\Http\Request;

class PageController extends Controller{
    public function index(){
       // return "Ini berasal dari page controller fungsi index";
       return view('welcome');
    }

    public function admin(){
        return "Halaman Admin";
    }

    public function tampilMhs(){
        $arrMhs = ['Budi','Joko','Rina','Wati'];

        //return view('tampilMhs',['mahasiswa'=>$arrMhs]);
        return view('tampilMhs')->with('mahasiswa',$arrMhs);
    }
    public function aksesCoba(){
       // $obj1=new \App\Http\Controllers\Mahasiswa\Coba;
        $obj1 = new coba();
        echo $obj1->tampilCoba();
    }
    public function registrasi(){
        return view('formRegistrasi');
    }
    public function prosesRegistrasi(Request $dataMhs){
       // dump($dataMhs);
        $validasiData=$dataMhs->validate([
            'email'=>['required'],
            'password'=>['required','min:6'],
            'nama'=>['required'],
            'nim'=>['required','size:9'],
            'jk'=>['required'],
            'alamat'=>['required'],
            'kecamatan'=>['required'],
            'kota'=>['required'],
            'provinsi'=>['required'],
            'kodepos'=>['required','size:5'],
        ]);

        $rataan=($dataMhs->uts+$dataMhs->uas)/2;

        if ($rataan<70){
            $status='tidak lulus';
        } else {
            $status='lulus';
        }
        return view('infoRegistrasi', compact('dataMhs','rataan','status'));
        /*
        echo $dataMhs->email."<br>";
        echo $dataMhs->password."<br>";
        echo $dataMhs->nama."<br>";
        echo $dataMhs->nim."<br>";
        echo $dataMhs->jk."<br>";
        echo $dataMhs->alamat."<br>";
        echo $dataMhs->kecamatan."<br>";
        echo $dataMhs->kota."<br>";
        echo $dataMhs->provinsi."<br>";
        echo $dataMhs->kodepos."<br>";*/

        /*echo $validasiData['email']."<br>";
        echo $validasiData['password']."<br>";
        echo $validasiData['nama']."<br>";
        echo $validasiData['nim']."<br>";
        echo $validasiData['jk']."<br>";
        echo $validasiData['alamat']."<br>";
        echo $validasiData['kecamatan']."<br>";
        echo $validasiData['kota']."<br>";
        echo $validasiData['provinsi']."<br>";
        echo $validasiData['kodepos']."<br>";*/
    }
}
