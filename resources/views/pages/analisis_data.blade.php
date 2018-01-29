@extends('layouts.default')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <div class="content">


        <h2 class="content-subhead">Analisis Data Laporan</h2>

        <form class="pure-form" action="{{route('admin.laporan_per_arho')}}" method="post">
          {{ csrf_field() }}
          <fieldset>
              <legend>Pencarian Data</legend>

              <label for="arho">Nama Arho</label>
              <select id="arho" name="arho">

                @foreach($list_arho as $arho)

                <option value="{{$arho->nama_lengkap}}">{{$arho->nama_lengkap}}</option>

                @endforeach

              </select>
          

              <label for="kecamatan">Kecamatan</label>
              <select id="kecamatan" name="kecamatan">

                @foreach($list_kecamatan as $kecamatan)
                  <option value="{{$kecamatan->nama_kecamatan}}">{{$kecamatan->nama_kecamatan}}</option>
                @endforeach
                 
              </select> 

              <button type="submit" class="pure-button pure-button-primary">Tampilkan</button>
          
          </fieldset>
      </form>

     

@if(session()->has('laporan'))
<div class="w3-panel w3-pale-green">
    <p style="text-align:center;"><b>Hasil Pencarian Data</b></p>
</div>
@endif

     
        </div>

@if(session()->has('laporan'))

@php
  $laporan = session('laporan');
@endphp

<div class="w3-container">

            <div class="pure-g">
                  
                  <div class="pure-u-1-2">

                   

                     <table class="w3-table" border="2">

                        <thead>
                          <tr>
                          <th style="text-align:center; vertical-align:middle;" rowspan="2">{{$laporan['nama_arho']}}</th>
                          <th style="text-align:center; vertical-align:middle;" rowspan="2">SALDO</th>
                          <th style="text-align:center; vertical-align:middle;" colspan="2" scope="colgroup">Bal 7</th>
                          <th style="text-align:center; vertical-align:middle;" colspan="2" scope="colgroup">Bal 30</th>
                         
                          </tr>

                          <tr>
                            <th scope="col" style="text-align:center; vertical-align:middle;">Rp.</th>
                            <th scope="col" style="text-align:center; vertical-align:middle;">%.</th>
                            <th scope="col" style="text-align:center; vertical-align:middle;">Rp.</th>
                            <th scope="col" style="text-align:center; vertical-align:middle;">%</th>
                          </tr>
                        </thead>
                        
                        <tbody>

                          <tr>
                            <td>Kecamatan {{$laporan['nama_kecamatan']}}</td>
                            <td>{{$laporan['jumlah_saldo']}}</td>
                            <td>{{$laporan['bal7']}}</td>
                            <td>{{$laporan['persen_bal7']}}</td>
                            <td>{{$laporan['bal30']}}</td>
                            <td>{{$laporan['persen_bal30']}}</td>
                          </tr>
                       
                        </tbody>
                      </table>
   
                  </div>

                  <!-- <div class="w3-container">

                      <div class="pure-u-1-2"><p>nanti disini petanya</p></div>

                  </div> -->
                
                  
                </div>
 

</div>

@endif
     

@push('scripts')


@endpush
@stop