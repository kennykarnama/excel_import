@extends('layouts.default')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.tablescroll.css')}}">



        <div class="content">

        <div class="w3-panel w3-pale-blue w3-leftbar w3-rightbar w3-border-blue">
        <p><b>Visualisasi Data Umum Kualitas Berdasarkan Kecamatan</b></p>
      </div>

     

         <!-- <h2 class="content-subhead">General</h2> -->

        <form class="pure-form" action="{{route('admin.detail_laporan_arho')}}" method="post">
          {{ csrf_field() }}
          <fieldset>
              <legend>Pencarian Data</legend>

              <label for="arho">Nama Arho</label>
              <select id="arho" name="arho">

            

                @foreach($list_arho as $arho)

                <option value="{{$arho->ARHO}}">{{$arho->ARHO}}</option>

                @endforeach

              </select>

               <label for="kecamatan">Kecamatan</label>
              <input type="text" id="kecamatan" name="kecamatan" value="{{$kecamatan}}">

              <button type="submit" class="pure-button pure-button-primary">Tampilkan</button>
          
          </fieldset>
      </form>

     




     
        </div>

       <!--  <div class='pure-g'>

          <div class="pure-1-2">

          </div>

          <div class="pure1-2">
             <iframe width="600" height="450" frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJD39HGxz61y0Rlnevskevh7o&key=AIzaSyCyeVc3UAC4QH-BTOMxDmHurREmagwv3DY" allowfullscreen></iframe>

          </div>

        </div> -->

<div class="content">
   <iframe width="600" height="450" frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/place?q=place_id:{{$place_id}}&key=AIzaSyCyeVc3UAC4QH-BTOMxDmHurREmagwv3DY" allowfullscreen></iframe>
</div>

@if(session()->has('detail_laporan'))

   <div class="content">
            <div class="w3-panel w3-pale-blue w3-leftbar w3-rightbar w3-border-blue">
                <h4 style="text-align:center;">Detail Laporan</h4>
                <p>{{$arho}}</p>
                <p>Kecamatan {{$kecamatan}}</p>
            </div>
        </div>

        <div class="w3-container" style="margin-bottom:15px;">

            <div class="pure-g">
                  
                  <div class="pure-u-1-2">

                   

                     <table class="w3-table" border="2" id="tabel_laporan_detail">

                        <thead>
                          <tr>
                          <th style="text-align:center; vertical-align:middle;" rowspan="2">{{$kecamatan}}</th>
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

                         

                           

                              @for($i=0;$i < count($detail_laporan); $i++)

                                @php
                                  $detail_laporan_i = $detail_laporan[$i];
                                 


                                @endphp
                               <tr>
                                 <td>Kelurahan {{$detail_laporan_i['nama_kelurahan']}}</td>
                                <td>{{$detail_laporan_i['jumlah_saldo']}}</td>
                                <td>{{$detail_laporan_i['bal7']}}</td>
                                <td>{{$detail_laporan_i['persen_bal7']}}</td>
                                <td>{{$detail_laporan_i['bal30']}}</td>
                                <td>{{$detail_laporan_i['persen_bal30']}}</td>
                                
                              </tr>

                              @endfor

                           
                          
                       
                        </tbody>
                      </table>
   
                  </div>

                
                
                  
                </div>
 

</div>  

 

@endif 


@push('scripts')


     
@endpush
@stop