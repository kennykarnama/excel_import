@extends('layouts.default')

@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.tablescroll.css')}}">



        <div class="content">

            <div class="w3-panel w3-pale-blue w3-leftbar w3-rightbar w3-border-blue">
            <p><b>Visualisasi Data Umum Kualitas Berdasarkan Kecamatan</b></p>
          </div>

     
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


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDct4JdjooCrU0Cb9-KwJyW9_sZ2bv7gHo&callback=initMap" async defer></script>   

<script type="text/javascript">

var map;

 var laporan_kecamatan_map;

      function initMap() {
        laporan_map = new google.maps.Map(document.getElementById('laporan_map'), {
          center: {lat: -7.257472, lng: 112.752088},
          zoom: 8
        });


  init_laporan_kecamatan_map();


      }

function init_laporan_kecamatan_map () {
  // body...
  
  var infoWindow;
  $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

        $.ajax({
                   type:'POST',
                   url:'{{route("admin.laporan_kecamatan")}}',
                   data:{

                   

                   },
                   success:function(data){

                    console.log(data);
                      
                    
                      var base_path = "{{asset('google_icons')}}";


                         infoWindow = new google.maps.InfoWindow();



                        

                         var icons = {
                        parking: {
                          name: "Baik",
                          icon: base_path+"/green_MarkerA.png"
                        },
                        library: {
                          name: "Buruk",
                          icon: base_path + "/red_MarkerB.png"
                        },
                       
                      };

                      for(var i=0;i<data.length;i++){


                        var test = data[i];

                        var nama_kecamatan = data[i].nama_kecamatan;

                        var gambar_kecamatan = base_path+"/"+data[i].icon;



                        var id_kecamatan = data[i].id_kecamatan;

                        var lat = data[i].lat;

                        var lng = data[i].lng;

                        var point = new google.maps.LatLng(
                            parseFloat(lat),
                            parseFloat(lng));




                       
                        

                         var marker = new google.maps.Marker({
                        map: laporan_map,
                        position: point,
                        icon:gambar_kecamatan
                      });




                      (function(marker, test) {

                        var tombol_detail  =document.createElement('div');
                        var a = document.createElement('a');

                        var url = '{{ route("admin.detail_laporan_kecamatan", ":kecamatan") }}';

                        url = url.replace(':kecamatan', test.nama_kecamatan);

                        a.href = url;

                        a.classList.add("pure-button","pure-button-primary");

                        a.innerHTML = "Lihat Laporan";

                        tombol_detail.appendChild(a);



                        var info_kecamatan_kontent = document.createElement('div');

                        info_kecamatan_kontent.classList.add("w3-panel","w3-pale-blue","w3-leftbar","w3-rightbar","w3-border-blue");
                        
                        var teks = document.createElement("p");

                        teks.textContent = "Kecamatan "+test.nama_kecamatan;

                        info_kecamatan_kontent.appendChild(teks);

                        info_kecamatan_kontent.appendChild(document.createElement('br'));

                        info_kecamatan_kontent.appendChild(a);



                      

                        // Attaching a click event to the current marker
                        google.maps.event.addListener(marker, "click", function(e) {
                          infoWindow.setContent(info_kecamatan_kontent);
                          infoWindow.open(laporan_map, marker);

                        });

                      })(marker, test);

                       

                      }


                      var legend = document.getElementById('legend');

                      for (var key in icons) {
                        var type = icons[key];
                        var name = type.name;
                        var icon = type.icon;
                        var div = document.createElement('div');
                        div.innerHTML = '<img src="' + icon + '"> ' + name;
                        legend.appendChild(div);
                      }

                       laporan_map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);

                      
                                

                   }
                });

  
}

$(document).ready(function  () {
  // body...
  // $('#tabel_laporan').tableScroll({width:600,containerClass:'w3-table'});

   $('#legend').show();
    $('#laporan_map').show();
  

  


});
</script>

 


     
@endpush
@stop