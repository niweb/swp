<head><title>OpenLayers Marker Popups</title>
  <style>
    #mapdiv {height: 350px; width: 100%;}
  </style>

</head>
<div class="partners form large-10 medium-9 columns">
    <?php if($location_name == null): ?>
    <fieldset>
        <legend><?=h(__('Become Schülerpate').' in ...')?><legend>
        <?= $this->Html->link(__('Berlin'), ['controller' => 'Partners', 'action' => 'register', 1]) ?>,
        <?= $this->Html->link(__('Frankfurt'), ['controller' => 'Partners', 'action' => 'register', 2]) ?>,
        <?= $this->Html->link(__('Ruhr'), ['controller' => 'Partners', 'action' => 'register', 3]) ?> oder
        <?= $this->Html->link(__('Braunschweig'), ['controller' => 'Partners', 'action' => 'register', 4]) ?><br>
    </fieldset>
    <?php else: ?>
    <?= $this->Form->create($partner); ?>
    <fieldset>
        <legend><?= h(__('Become Schülerpate').' in '.$location_name)?></legend>

        <h3><?= __('Login Details') ?></h3>
	 <?php
            echo $this->Form->input('user.email');
            echo $this->Form->input('user.password');
        ?>
	<h3><?= __('Personal Details') ?></h3>
        <?php
            echo $this->Form->input('user.first_name', ['label' => __('first_name')]);
            echo $this->Form->input('user.last_name', ['label' => __('last_name')]);
            echo $this->Form->input('age', ['label' => __('age')]);
            echo $this->Form->label(__('sex'));
            echo $this->Form->select('sex', ['m' => __('male'), 'f' => __('female')]);
            echo $this->Form->input('degree_course', ['label' => __('degree_course')]);
            echo $this->Form->input('job', ['label' => __('job')]);
        ?>
        <h3><?= __('Contact Details') ?></h3>
        <?php
            echo $this->Form->input('street', ['label' => __('street'), 'required' => true, 'id'=>'street', 'type'=>'text']);
            echo $this->Form->input('house_number', ['label' => __('house_number'), 'required' => true]);
            echo $this->Form->input('house_number_addition',['label' => __('house_number_addition')]);
            echo $this->Form->input('postcode', ['label' => __('postcode'), 'required' => true]);
            echo $this->Form->input('city', ['label' => __('city'),'required' => true]);
            echo $this->Form->input('telephone', ['label' => __('telephone'),'required' => true]);
            echo $this->Form->input('mobile',['label' => __('mobile')]);
        ?>
        <h3><?= __('Tutorship') ?></h3>
        
        <?= $this->Form->label(__('preferred_classranges')) ?>
        <table border=0><tr>
        <?php
            foreach($classranges as $classrange){
                echo '<td>';
                echo $this->Form->input("preferredClassranges.{$classrange['id']}", ['type' => 'checkbox', 'label' => $classrange['name']]);
                echo '</td>';
            }
        ?>
        </tr></table>
        
        <?= $this->Form->label(__('preferred_schooltypes')) ?>
        <table border=0><tr>
        <?php
            foreach($schooltypes as $schooltype){
                echo '<td>';
                echo $this->Form->input("preferredSchooltypes.{$schooltype['id']}", ['type' => 'checkbox', 'label' => $schooltype['name']]);
                echo '</td>';
            }
        ?>
        </tr></table>
        
        <?php
            echo $this->Form->label(__('preferred_subjects'));
            echo '<em>'. __("preferred_subjects_addition") .'</em>';
            echo '<table border=0><tr><th>'.__('subject').'</th><th>'.__('max_grade').'</th></tr>';
            foreach($subjects as $subject){
                echo '<tr><td>'. $this->Form->label($subject['name']) .'</td>';
                echo '<td>'. $this->Form->input("preferredSubjects.{$subject['id']}", ['label' => false]) .'</td></tr>';
            }
        ?>
        </table>

        <?php
            echo $this->Form->input('teach_time', ['label' => __('teach_time'), 'required' => true]);
            echo $this->Form->input('extra_time', ['label' => __('extra_time'), 'required' => true]);
            echo $this->Form->input('spend_time', ['label' => __('spend_time'), 'required' => true]);
            
            echo $this->Form->input('experience', ['label' => __('experience'), 'required' => true]);
            
            echo $this->Form->label(__('preferred_gender'));
            echo $this->Form->select('preferred_gender', ['' => __('whatever'), 'm' => __('male'), 'f' => __('female')]);
            
            echo $this->Form->label(__('support_wish'));
            echo $this->Form->textarea('support_wish');
            
            echo $this->Form->input('reason_for_decision', ['label' => __('reason_for_decision'), 'required' => true]);            
            echo $this->Form->input('additional_informations', ['label' => __('additional_informations')]);
            echo $this->Form->input('reason_for_schuelerpaten', ['label' => __('reason_for_schuelerpaten'), 'required' => true]);
    
        ?>
    </fieldset>


     <div id="mapdiv"></div>
     
     <?php echo $location_name; ?>
    </br>



    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <?php endif; ?>
<script src="http://www.openlayers.org/api/OpenLayers.js"></script>

<script type="text/javascript" language="JavaScript">
    var location_name="<?php echo $location_name; ?>";
    

    map = new OpenLayers.Map('mapdiv');  //create map at div
    map.addLayer(new OpenLayers.Layer.OSM());

    epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
    projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)

    var zoom=12;
  if(location_name=='Berlin'){
    var center  = new OpenLayers.LonLat( 13.40495,52.52000 ).transform(epsg4326, projectTo);  
  }else if(location_name=="Frankfurt"){
    var center  = new OpenLayers.LonLat( 8.68212,50.11092 ).transform(epsg4326, projectTo);
  }else if(location_name=="Ruhr"){
     var center  = new OpenLayers.LonLat( 7.62827,51.36591 ).transform(epsg4326, projectTo);
  }else if(location_name=="Braunschweig"){
     var center  = new OpenLayers.LonLat( 10.52677,52.26887 ).transform(epsg4326, projectTo);
  }
    
  map.setCenter (center, zoom);  

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
