@extends('layouts.default')

@section('content')
	
	<div class="content">

          <div class="w3-panel w3-pale-blue w3-leftbar w3-rightbar w3-border-blue">
          <p><b>Visualisasi Data Umum Kualitas Berdasarkan Arho</b></p>
        </div>

        <form class="pure-form" method="post" action="{{route('admin.analisis_data_arho.get_laporan_arho')}}">
		     {{ csrf_field() }}
		    <fieldset>
		        <legend>Pencarian Berdasarkan Arho</legend>

		        <label for="arho">Nama Arho</label>
		        <select id="arho" name="arho">
		            <option value="0">Semua Arho</option>

		            @foreach($list_arho as $arho)
		            	<option value="{{$arho->nama_lengkap}}">{{$arho->nama_lengkap}}</option>
		            @endforeach
		        </select>

		        <button type="submit" class="pure-button pure-button-primary">Tampilkan!</button>
		    </fieldset>
		</form>

      </div>
@stop