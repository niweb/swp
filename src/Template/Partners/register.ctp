<head><title>OpenLayers Marker Popups</title>
  <style>
    #mapdiv {height: 350px; width: 100%;}
  </style>

</head>
<div class="partners form large-10 medium-9 columns">
    <?= $this->Form->create($partner); ?>
    <fieldset>
        <legend><?= __('Become Schülerpate') ?></legend>
        <h3><?= __('Login Details') ?></h3>
	 <?php
            echo $this->Form->input('user.email');
            echo $this->Form->input('user.password');
            echo $this->Form->input('user.location_id',array('id'=>'location_id','label'=>'Standort','options'=>$locations,'empty'=>false,'onchange'=>'change_center(this.value)') /*['options' => $locations, 'empty' => false]*/);
        ?>
	<h3><?= __('Personal Details') ?></h3>
        <?php
            echo $this->Form->input('user.first_name', ['label' => __('First Name')]);
            echo $this->Form->input('user.last_name', ['label' => __('Last Name')]);
            echo $this->Form->input(__('age'));
            echo $this->Form->label(__('sex'));
            echo $this->Form->select('sex', ['m' => __('male'), 'f' => __('female')]);
            echo $this->Form->input(__('degree_course'));
            echo $this->Form->input(__('job'));
        ?>
        <h3><?= __('Contact Details') ?></h3>
        <?php
            echo $this->Form->input(__('street'), ['required' => true, 'id'=>'street', 'type'=>'text', 'onchange'=>'getStreet(this.value)']);
            echo $this->Form->input('house_number', ['label' => __('House Number')]);
            echo $this->Form->input('house_number_addition', ['label' => __('House Number Addition')]);
            echo $this->Form->input('postcode', ['label' => __('Postcode')]);
            echo $this->Form->input('city', ['label' => __('City')]);
            echo $this->Form->input('telephone', ['label' => __('Telephone')]);
            echo $this->Form->input('mobile', ['label' => __('Mobile')]);
        ?>
        <h3><?= __('Tutorship') ?></h3>
        <?php
            echo $this->Form->input('teach_time', ['label' => __('How much time (in minutes) would you like to spend teaching? (at least 90)')]);
            echo $this->Form->input('extra_time', ['label' => __('How much time (in minutes) would you like to spend additionally per month for workshops or events with your student?')]);
            echo $this->Form->input('spend_time', ['label' => __('For how long will you be available in the near future? (at least one year)')]);
            
            echo $this->Form->input('experience', ['label' => __('What experiences have you already made with tutoring or sponsorships?')]);
            
            echo $this->Form->label(__('Preferred Gender of your student'));
            echo $this->Form->select('preferred_gender', ['' => __('whatever'), 'm' => __('male'), 'f' => __('female')]);
            
            echo $this->Form->label(__('What kind of support would you like to get from us during your sponsorship?'));
            echo $this->Form->textarea('support_wish');
            
            echo $this->Form->input('reason_for_decision', ['label' => __('Why did you choose us?')]);            
            echo $this->Form->input('additional_informations', ['label' => __('Is there anything else we should know about you?')]);
            echo $this->Form->input('reason_for_schuelerpaten', ['label' => __('How did you hear about Schülerpaten?')]);
            
        ?>
    </fieldset>


     <div id="mapdiv"></div>
     <div id="position">
     </div>
</br>



    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
<script src="http://www.openlayers.org/api/OpenLayers.js"></script>

<script type="text/javascript" language="JavaScript">


    map = new OpenLayers.Map('mapdiv');  //create map at div
    map.addLayer(new OpenLayers.Layer.OSM());

    epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
    projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)

    var zoom=13;
    var center  = new OpenLayers.LonLat( 13.40495,52.52000 ).transform(epsg4326, projectTo);
    map.setCenter (center, zoom);  

//change the view of the map to the selected location
  function change_center(location_id){
    if(location_id=='1'){
      var center  = new OpenLayers.LonLat( 13.40495,52.52000 ).transform(epsg4326, projectTo);
    } 
    else if(location_id=='2'){
      var center  = new OpenLayers.LonLat( 8.68212,50.11092 ).transform(epsg4326, projectTo);
    }    
    else if(location_id=='3'){
      var center  = new OpenLayers.LonLat( 7.62827,51.36591 ).transform(epsg4326, projectTo);
    }
    else if(location_id=='4'){
      var center  = new OpenLayers.LonLat( 10.52677,52.26887 ).transform(epsg4326, projectTo);
    }
    else{
      var center  = new OpenLayers.LonLat( 13.40495,52.52000 ).transform(epsg4326, projectTo);
    }  
    map.setCenter (center, zoom);  
  }

  function add_marker(longitude,latitude, description){
   var vectorLayer = new OpenLayers.Layer.Vector("Overlay");
    
    // Define markers as "features" of the vector layer:
   var feature = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point( 13.391260,52.552200 ).transform(epsg4326, projectTo),
            {description:'This is the value of<br>the description attribute'} ,
            {externalGraphic: '/img/marker.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
        );    
    vectorLayer.addFeatures(feature);
  }
</script>
 <!-- <script>

     function initialize_location(coords){
         var lng= coords.longitude;
         var lat= coords.latitude;
        var lonLat = new OpenLayers.LonLat( lng,lat ).transform(epsg4326, projectTo);
     //    document.getElementById('position').innerHTML = 'lat: ' + lat + 'longi: ' +lng;

             map.setCenter (lonLat, zoom);

          }




    map = new OpenLayers.Map("mapdiv");
    map.addLayer(new OpenLayers.Layer.OSM());
    
    epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
    projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)
   
    var lonLat = new OpenLayers.LonLat( 13.391260,52.552200 ).transform(epsg4326, projectTo);
          
    
    var zoom=14;
   

    var vectorLayer = new OpenLayers.Layer.Vector("Overlay");
    
    // Define markers as "features" of the vector layer:
   var feature = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point( 13.391260,52.552200 ).transform(epsg4326, projectTo),
            {description:'This is the value of<br>the description attribute'} ,
            {externalGraphic: '/img/marker.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
        );    
    vectorLayer.addFeatures(feature);
   
    var feature = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point( 13.510882, 52.535047  ).transform(epsg4326, projectTo),
            {description:'Big Ben'} ,
            {externalGraphic: '/img/marker.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
        );    
    vectorLayer.addFeatures(feature);

    var feature = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point( -0.119623, 51.503308  ).transform(epsg4326, projectTo),
            {description:'London Eye'} ,
            {externalGraphic: '/img/marker.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
        );    
    vectorLayer.addFeatures(feature);

   
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

    //Postionen bestimmen
         navigator.geolocation.getCurrentPosition(function(position){ initialize_location(position.coords);        
      }, function(){
        document.getElementById('position').innerHTML = 'Deine Position konnte nicht ermittelt werden';
      })  ;
      
  </script>

-->
</div>
