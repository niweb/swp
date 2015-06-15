<head>
     <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <?php if(isset($matchmaker)) : ?>
			<li><?= $this->Form->postLink(
					__('Delete'),
					['action' => 'delete', $student->id],
					['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]
				)
			?></li>
			<li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Tandems'), ['controller' => 'Tandems', 'action' => 'index']) ?></li>
		<?php endif; ?>
    </ul>
</div>
<div class="students form large-10 medium-9 columns">
    <?= $this->Form->create($student); ?>
    <fieldset>
        <legend><?= __('Edit Student') ?></legend>
        <?php
            echo $this->Form->input('first_name', ['label' => __('first_name')]);
            echo $this->Form->input('last_name', ['label' => __('last_name')]);
			echo $this->Form->label(__('sex'));
            echo $this->Form->select('sex', ['m' => __('male'), 'f' => __('female')]);
			echo $this->Form->input('street', ['label' => __('street'), 'onchange'=>'save_street(this.value)']);
			echo $this->Form->input('house_number', ['label' => __('house_number')]);
			echo $this->Form->input('house_number_addition', ['label' => __('house_number_addition')]);
			echo $this->Form->input('postcode', ['label' => __('postcode'), 'onchange'=>'save_postcode(this.value)']);
			echo $this->Form->input('city', ['label' => __('city'), 'onchange'=>'save_city(this.value)']);
            echo $this->Form->input('telephone', ['label' => __('telephone')]);
            echo $this->Form->input('mobile', ['label' => __('mobile')]);
            echo $this->Form->input('lat', ['label' => __('lat'), 'id'=>'lat', /*'type'=>'hidden'*/]);
            echo $this->Form->input('lng', ['label' => __('lng'), 'id'=>'lng'/*,'type'=>'hidden'*/]);
        ?>
    </fieldset>
  <div id="results_coords"></div>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<script>
var street;
var postcode;
var city;
    function save_street(val){
        street=val;
    }
    function save_postcode(val){
        postcode=val;
    }
    function save_city(val){
        city=val;
     //   document.getElementById("lng").value='';
       // document.getElementById("lat").value='';
        address=street+','+city+','+postcode;
        addr_search(address);
    }
    function addr_search(wert) {
        $.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=3&q=' + wert, function (data) {
        var items = [];
        var latitude;
        var longitude;

        $.each(data, function (key, val) {
            latitude=document.getElementById('lat');
            latitude.value=val.lat;
            longitude=document.getElementById('lng');
            longitude.value=val.lon;
           /* var str = JSON.stringify([val.lat, val.lon]);
            items.push(str);


            items.push("<li><a href='#' onclick='alert(" + str + ");'>" + val.display_name + '</a></li>');*/
        });
   

     $('#results_coords').empty();
        if (items.length !== 0) {
            $('<p>', {
                html: "Wählen Sie bitte die Straße des Schülern aus:"
            }).appendTo('#results_coords');
            $('<ul/>', {
                'class': 'my-new-list',
                html: items.join('')
            }).appendTo('#results_coords');
        } else {
            $('<p>', {
                html: "No results found"
            }).appendTo('#results_coords');
            }
        });
    }
</script>
