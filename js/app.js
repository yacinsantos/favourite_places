$(document).ready(function(){     
    
    mapboxgl.accessToken = 'pk.eyJ1IjoieWFjaW5zYW50b3MiLCJhIjoiY2swNGluMGZ4MTg3ODNicDQxa2VuaHRkaCJ9.tRPvHNz_Nuc0MqReVT8FXQ';
    var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [0, 0]
    });

    var layerList = document.getElementById('menu');
    var inputs = layerList.getElementsByTagName('input');
    
    function switchLayer(layer) {
    var layerId = layer.target.id;
    map.setStyle('mapbox://styles/mapbox/' + layerId);
    }
    
    for (var i = 0; i < inputs.length; i++) {
    inputs[i].onclick = switchLayer;
    }

    map.addControl(new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl
    }));

    $.ajax({
        url:"get_positions.php",
        method:"GET",
        success:function(data)
        {
            jQuery.each(JSON.parse(data), function() {
                var popup = new mapboxgl.Popup({ offset: 25 })
                .setHTML('<h3>'+ this.name +'</h3><br /><p>'+ this.description +'</p>');
                var lng = this.lng;
                var lat = this.lat;
                var marker = new mapboxgl.Marker()
                .setLngLat({lng, lat})
                .setPopup(popup)
                .addTo(map);
           });

        }
    });
    

    $("#add").click(function(){
        if($("#name").val() != "" && $("#description").val() != "" ){
            window.alert('click once on the place you want');
            var i = 0;
            map.on('click', function(e) {    
                if(i == 0){
                    var name = $("#name").val();
                    var description = $("#description").val();
                    var lng = e.lngLat.lng;
                    var lat = e.lngLat.lat;
                    $.ajax({
                        url:"insert_position.php",
                        method:"POST",
                        data:{
                            name:name,
                            description:description,
                            lng:lng,
                            lat:lat
                        },
                        success:function(data)
                        {
                        }
                    });
                    var popup = new mapboxgl.Popup({ offset: 25 })
                    .setHTML('<h3>'+ name +'</h3><br /><p>'+ description +'</p>');

                    var marker = new mapboxgl.Marker()
                    .setLngLat(e.lngLat)
                    .setPopup(popup)
                    .addTo(map);
                    i++;
                }
                
            });
        }else {
            alert('You have to fill all the fieds!')
        }
        
    })
})