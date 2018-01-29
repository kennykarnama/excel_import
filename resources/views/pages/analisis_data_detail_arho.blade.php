@extends('layouts.default')

  @section('content')

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

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

@stop