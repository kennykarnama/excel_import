<?php

namespace App\AnalisisData;


use DB;

class MyAnalisis {

	public static function fetch_arho(){
		
		$query = DB::table('arho')->where('arho.is_aktif','=',1)->get();

		return $query;
	}

	public static function fetch_kecamatan(){
		$query = DB::table('kecamatan')->where('kecamatan.is_aktif','=',1)->get();

		return $query;
	}

	public static function hitung_jumlah_saldo($arho,$kecamatan)
	{
		# code...

		$jumlah_saldo = DB::table('report')->where('report.ARHO','=',$arho)
											->where('report.KECAMATAN','=',$kecamatan)
											->sum('report.SALDO2');

		return $jumlah_saldo;

	}

	public static function hitung_jumlah_saldo_bal($arho,$kecamatan,$bal)
	{
		# code...
		$jumlah_saldo = DB::table('report')->where('report.ARHO','=',$arho)
											->where('report.KECAMATAN','=',$kecamatan)
											->where('report.EOD','<=',$bal)
											->sum('report.SALDO2');

		return $jumlah_saldo;

	}

}