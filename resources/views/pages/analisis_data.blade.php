@extends('layouts.default')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.tablescroll.css')}}">



        <div class="content">


        

        <form class="pure-form" action="{{route('admin.laporan_arho')}}" method="post">
          {{ csrf_field() }}
          <fieldset>
              <legend>Pencarian Data</legend>

              <label for="arho">Nama Arho</label>
              <select id="arho" name="arho">

              <option value="0">Semua</option>

                @foreach($list_arho as $arho)

                <option value="{{$arho->nama_lengkap}}">{{$arho->nama_lengkap}}</option>

                @endforeach

              </select>

              <button type="submit" class="pure-button pure-button-primary">Tampilkan</button>
          
          </fieldset>
      </form>

     




     
        </div>




   

    

@if(session()->has('laporan'))

@php
  $laporan = session('laporan');
@endphp

 @if(count($laporan) > 1)

 <div class="content">
  <div class="w3-panel w3-pale-green">
    <p style="text-align:center;"><b>Hasil Pencarian Data</b></p>
  </div>
 </div>
<div class="w3-container" style="margin-bottom:15px;">

            <div class="pure-g">
                  
                  <div class="pure-u-1-2">

                   

                     <table class="w3-table" border="2" id="tabel_laporan">

                        <thead>
                          <tr>
                          <th style="text-align:center; vertical-align:middle;" rowspan="2">{{$laporan[0]}}</th>
                          <th style="text-align:center; vertical-align:middle;" rowspan="2">SALDO</th>
                          <th style="text-align:center; vertical-align:middle;" colspan="2" scope="colgroup">Bal 7</th>
                          <th style="text-align:center; vertical-align:middle;" colspan="2" scope="colgroup">Bal 30</th>
                          <th style="text-align:center; vertical-align:middle;" rowspan="2">Actions</th>
                          </tr>

                          <tr>
                            <th scope="col" style="text-align:center; vertical-align:middle;">Rp.</th>
                            <th scope="col" style="text-align:center; vertical-align:middle;">%.</th>
                            <th scope="col" style="text-align:center; vertical-align:middle;">Rp.</th>
                            <th scope="col" style="text-align:center; vertical-align:middle;">%</th>
                            
                          </tr>
                        </thead>
                        
                        <tbody>

                         

                           

                              @for($i=1;$i < count($laporan); $i++)

                                @php
                                  $laporan_i = $laporan[$i];
                                  $nama_arho = $laporan[0];


                                @endphp
                               <tr>
                                 <td>Kecamatan {{$laporan_i['nama_kecamatan']}}</td>
                                <td>{{$laporan_i['jumlah_saldo']}}</td>
                                <td>{{$laporan_i['bal7']}}</td>
                                <td>{{$laporan_i['persen_bal7']}}</td>
                                <td>{{$laporan_i['bal30']}}</td>
                                <td>{{$laporan_i['persen_bal30']}}</td>
                                <td><a class="w3-button w3-blue" href="{{ URL::route('admin.detail_laporan_arho', [$nama_arho,$laporan_i['nama_kecamatan']]) }}">Lihat Detail</a></td>
                              </tr>

                              @endfor

                           
                          
                       
                        </tbody>
                      </table>
   
                  </div>

                  <!-- <div class="w3-container">

                      <div class="pure-u-1-2"><p>nanti disini petanya</p></div>

                  </div> -->
                
                  
                </div>
 

</div>


@else

<div class="content">
<div class="w3-panel w3-red">
  <p style="text-align:center;"><b>Maaf,Data tidak ada</b></p>
</div>
</div>


@endif

@endif
     

@push('scripts')

<script type="text/javascript" src="{{asset('js/jquery.tablescroll.js')}}"></script>




<script type="text/javascript">

var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }

$(document).ready(function  () {
  // body...
  // $('#tabel_laporan').tableScroll({width:600,containerClass:'w3-table'});
  initMap();
  $('#map').show();


});
</script>

 


     
@endpush
@stop