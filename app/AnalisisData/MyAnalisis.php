<?php

namespace App\AnalisisData;


use DB;

class MyAnalisis {

	public static function fetch_arho(){
		
		$query = DB::table('arho')->where('arho.is_aktif','=',1)->get();

		return $query;
	}

	public static function fetch_arho_by_kecamatan($kecamatan)
	{
		# code...
		$query = DB::table('report')->select('report.ARHO')->distinct()
									->where('report.KECAMATAN','=',$kecamatan)->get();

		return $query;
	}

	public static function fetch_kecamatan(){
		$query = DB::table('kecamatan')->where('kecamatan.is_aktif','=',1)->get();

		return $query;
	}

	public static function fetch_kecamatan_from_xls()
	{
		# code...
		$query = DB::table('report')->select('report.KECAMATAN')->distinct()
					 ->get();

		return $query;
	}

	public static function fetch_kelurahan($kecamatan)
	{
		# code...
		$query = DB::table('report')->select('report.KELURAHAN')->distinct()
						   ->where('report.KECAMATAN','=',$kecamatan)
						    ->get();
		
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

	public static function hitung_jumlah_saldo_kelurahan($arho,$kelurahan)
	{
		# code...
		$jumlah_saldo = DB::table('report')->where('report.ARHO','=',$arho)
											->where('report.KELURAHAN','=',$kelurahan)
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

	public static function hitung_jumlah_saldo_bal_kelurahan($arho,$kelurahan,$bal)
	{
		# code...
		$jumlah_saldo = DB::table('report')->where('report.ARHO','=',$arho)
											->where('report.KELURAHAN','=',$kelurahan)
											->where('report.EOD','<=',$bal)
											->sum('report.SALDO2');

		return $jumlah_saldo;
	}

	public static function is_valid_wilayah($jumlah_saldo){
		return $jumlah_saldo > 0;
	}

}