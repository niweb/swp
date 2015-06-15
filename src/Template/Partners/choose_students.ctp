 <head><title>OpenLayers Marker Popups</title>
  <style>
    #mapdiv {height: 350px; width: 100%;}
  </style>

</head>


          <div>     
            <p> Hier sehen Sie eine Karte von Schülern welche mit ihren Präferenzen übereinstimmen</p>
        </div>

<div id="mapdiv"></div>

<script src="http://www.openlayers.org/api/OpenLayers.js"></script>

<script type="text/javascript" language="JavaScript">
    var latitude=<?php echo $student->lat?>;
    var longitude=<?php echo $student->lng;?>;
    var description1="Vorname: <?php echo $student->first_name;?> <br>Nachname: <?php echo $student->last_name;?><br>Geschlecht: <?php echo $student->sex;?>";

    map = new OpenLayers.Map('mapdiv');  //create map at div with id=mapdiv
    map.addLayer(new OpenLayers.Layer.OSM());

    epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
    projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)

    var zoom=12;
    var center  = new OpenLayers.LonLat( 13.40495,52.52000 ).transform(epsg4326, projectTo);
    map.setCenter (center, zoom);  

    var vectorLayer = new OpenLayers.Layer.Vector("Overlay");
    

   // Define markers as "features" of the vector layer;

    var feature = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point( longitude,latitude ).transform(epsg4326, projectTo),
            {description:description1} ,
            {externalGraphic: '/img/marker.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
        );    
    vectorLayer.addFeatures(feature);
/*    
    var feature1 = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point( 13.3917541,52.552586  ).transform(epsg4326, projectTo),
            {description:'Big Ben'} ,
            {externalGraphic: '/img/marker.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
        );    
    vectorLayer.addFeatures(feature1);*/
 
    map.addLayer(vectorLayer);
 
    
    //Add a selector control to the vectorLayer with popup functions
    var controls = {
      selector: new OpenLayers.Control.SelectFeature(vectorLayer, { onSelect: createPopup, onUnselect: destroyPopup })
    };

    function createPopup(feature) {
      feature.popup = new OpenLayers.Popup.FramedCloud("pop",
          feature.geometry.getBounds().getCenterLonLat(),
          null,
          '<div class="markerContent">'+feature.attributes.description+'</div>',
          null,
          true,
          function() { controls['selector'].unselectAll(); }
      );
      //feature.popup.closeOnMove = true;
      map.addPopup(feature.popup);
    }

    function destroyPopup(feature) {
      feature.popup.destroy();
      feature.popup = null;
    }
    
    map.addControl(controls['selector']);
    controls['selector'].activate();
  //}
</script>
<!--<script>add_marker("<?php echo $lng; ?>","<?php echo $lat; ?>");</script>-->
