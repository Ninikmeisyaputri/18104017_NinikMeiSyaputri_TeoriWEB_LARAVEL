<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BarangModel; // menambahkan model yg di gunakan

class apicontroller extends Controller
{
    public function get_all_barang(){
        return response()->json(BarangModel::all(), 200);
    }
    public function insert_data_barang(Request $request){
        $insert_barang = new BarangModel;
        $insert_barang->nama_barang = $request->namaBarang;
        $insert_barang->jumlah_barang = $request->jmlBarang;
        $insert_barang->save();
        return response([
            'status' => 'OK',
            'masage' => 'Barang Disimpan',
            'data' => $insert_barang
        ], 200);
    }
    public function update_data_barang(Request $request, $id){
        //cek terlenih dahulu data yang akan di update melalui id
        //apakah barang ada atau tidak, jika tidak return not found
        $check_barang = BarangModel::firstWhere('kode_barang', $id);
        if($check_barang){
            //echo 'data yang anda cari tersedia';
            $data_barang = BarangModel::find($id);
            $data_barang->nama_barang = $request->namaBarang;
            $data_barang->jumlah_barang = $request->jmlBarang;
            $data_barang->save();
            return response([
                'status' => 'OK',
                'massage' => 'Data Berhasil Dirubah',
                'update-data' => $data_barang
            ], 200);
        } else {
            //echo 'tidak ada';
            return response([
                'status' => 'Not Found',
                'massage' => 'Kode Barang Tidak Ditemukan'
            ], 400);           
        }
    }
    public function delete_data_barang($id){
        //cek terlenih dahulu data yang akan di update melalui id
        //apakah barang ada atau tidak, jika tidak return not found
        $check_barang = BarangModel::firstWhere('kode_barang', $id);
        if($check_barang){
            BarangModel::destroy($id);
            return response([
                'status' => 'OK',
                'massage' => 'Data Dihapus',
            ], 200);
    } else {
        return response([
            'status' => 'Not Found',
            'massage' => 'Kode Barang Tidak Ditemukan'
        ], 400); 
    }
    //
}
}
