@extends('layouts.default')

@section('content')
	
	<div class="content">

          <div class="w3-panel w3-pale-blue w3-leftbar w3-rightbar w3-border-blue">
          <p><b>Visualisasi Data Umum Kualitas Berdasarkan Arho</b></p>
        </div>

        <form class="pure-form">
		     {{ csrf_field() }}
		    <fieldset>
		        <legend>Pencarian Berdasarkan Arho</legend>

		        <label for="arho">Nama Arho</label>
		        <select id="arho" name="arho">
		           <option selected="true" disabled="disabled">Pilih Arho</option>    

		            @foreach($list_arho as $arho)
		            	<option value="{{$arho->nama_lengkap}}">{{$arho->nama_lengkap}}</option>
		            @endforeach
		        </select>

		        <button type="button" class="pure-button pure-button-primary" id="tombol-visual-map">Tampilkan!</button>
		    </fieldset>
		</form>

      </div>

@push('scripts')


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDct4JdjooCrU0Cb9-KwJyW9_sZ2bv7gHo&callback=initMap" async defer></script>   


	<script type="text/javascript">

	var map;

 	var laporan_kecamatan_map;

 	

      function initMap() {
        laporan_kecamatan_map = new google.maps.Map(document.getElementById('laporan_map'), {
          center: {lat: -7.257472, lng: 112.752088},
          zoom: 8
        });

    }

	function load_info_kecamatan (arho) {
		// body...
		 var infoWindow;

		$.ajaxSetup({
			            headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			            }
        			});

				$.ajax({
		               type:'POST',
		               url:'{{route("admin.analisis_data_arho.get_maps_arho")}}',
		               data:{

		               	'arho':arho

		               },
		               success:function(data){

		               	initMap();

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
                        map: laporan_kecamatan_map,
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
                          infoWindow.open(laporan_kecamatan_map, marker);

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

                       laporan_kecamatan_map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);

                      
                                
		        		
		        			 $('#laporan_map').show();          
		                                

		               }
            		});
	}
		$(document).ready(function  () {
			// body...
			$("#tombol-visual-map").click(function () {
				// body...

				var arho = $('#arho').val();

				load_info_kecamatan(arho);

			});
		});
	</script>
	
@endpush
@stop

