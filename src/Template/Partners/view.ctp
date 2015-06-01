<head><title>OpenLayers Marker Popups</title>
  <style>
    #mapdiv {height: 350px; width: 100%;}
  </style>

</head>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Partner'), ['action' => 'edit', $partner->id]) ?> </li>
		<?php if(isset($matchmaker)) : ?>
			<li><?= $this->Form->postLink(__('Delete Partner'), ['action' => 'delete', $partner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partner->id)]) ?> </li>
			<li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Tandems'), ['controller' => 'Tandems', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Tandem'), ['controller' => 'Tandems', 'action' => 'add']) ?></li>
		<?php endif; ?>
    </ul>
</div>
<div class="partners view large-10 medium-9 columns">
    <h2><?= h($user->first_name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($partner->id) ?></p>
            <h6 class="subheader"><?= __('First Name') ?></h6>
            <p><?= h($user->first_name) ?></p>
            <h6 class="subheader"><?= __('Last Name') ?></h6>
            <p><?= h($user->last_name) ?></p>
            <h6 class="subheader"><?= __('Sex') ?></h6>
            <p><?= h($partner->sex) ?></p>
            <h6 class="subheader"><?= __('Age') ?></h6>
            <p><?= $this->Number->format($partner->age) ?></p>
            <h6 class="subheader"><?= __('Degree Course') ?></h6>
            <p><?= h($partner->degree_course) ?></p>
            <h6 class="subheader"><?= __('Job') ?></h6>
            <p><?= h($partner->job) ?></p>
            <h6 class="subheader"><?= __('Street') ?></h6>
            <p><?= h($partner->street) ?></p>
            <h6 class="subheader"><?= __('House Number') ?></h6>
            <p><?= h($partner->house_number) ?></p>
            <h6 class="subheader"><?= __('House Number Addition') ?></h6>
            <p><?= h($partner->house_number_addition) ?></p>
            <h6 class="subheader"><?= __('Postcode') ?></h6>
            <p><?= h($partner->postcode) ?></p>
            <h6 class="subheader"><?= __('City') ?></h6>
            <p><?= h($partner->city) ?></p>
            <h6 class="subheader"><?= __('Telephone') ?></h6>
            <p><?= h($partner->telephone) ?></p>
            <h6 class="subheader"><?= __('Mobile') ?></h6>
            <p><?= h($partner->mobile) ?></p>
            <h6 class="subheader"><?= __('How much time (in minutes) would you like to spend teaching? (at least 90)') ?></h6>
            <p><?= $this->Number->format($partner->teach_time) ?></p>
            <h6 class="subheader"><?= __('How much time (in minutes) would you like to spend additionally per month for workshops or events with your student?') ?></h6>
            <p><?= $this->Number->format($partner->extra_time) ?></p>
            <h6 class="subheader"><?= __('For how long will you be available in the near future? (at least one year)') ?></h6>
            <p><?= h($partner->spend_time) ?></p>
            <h6 class="subheader"><?= __('What experiences have you already made with tutoring or sponsorships?') ?></h6>
            <p><?= h($partner->experience) ?></p>
            <h6 class="subheader"><?= __('Preferred Gender of your student') ?></h6>
            <p><?= h($partner->preferred_gender) ?></p>
            <h6 class="subheader"><?= __('What kind of support would you like to get from us during your sponsorship?') ?></h6>
            <p><?= h($partner->support_wish) ?></p>
            <h6 class="subheader"><?= __('Why did you choose us?') ?></h6>
            <p><?= h($partner->reason_for_decision) ?></p>
            <h6 class="subheader"><?= __('Is there anything else we should know about you?') ?></h6>
            <p><?= h($partner->additional_informations) ?></p>
            <h6 class="subheader"><?= __('How did you hear about Schülerpaten?') ?></h6>
            <p><?= h($partner->reason_for_schuelerpaten) ?></p>
            <h6 class="subheader"><?= __('Location') ?></h6>
            <p><?= $partner->has('location') ? $this->Html->link($partner->location->name, ['controller' => 'Locations', 'action' => 'view', $partner->location->id]) : '' ?></p>
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $partner->has('user') ? $this->Html->link($partner->user->email, ['controller' => 'Users', 'action' => 'view', $partner->user->id]) : '' ?></p>
        </div>
    </div>
</div>

<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related PreferredClassranges') ?></h4>
    <?php if (!empty($partner->preferred_classranges)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Partner Id') ?></th>
            <th><?= __('Classrange Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($partner->preferred_classranges as $preferredClassranges): ?>
        <tr>
            <td><?= h($preferredClassranges->id) ?></td>
            <td><?= h($preferredClassranges->partner_id) ?></td>
            <td><?= h($preferredClassranges->classrange_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'PreferredClassranges', 'action' => 'view', $preferredClassranges->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'PreferredClassranges', 'action' => 'edit', $preferredClassranges->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PreferredClassranges', 'action' => 'delete', $preferredClassranges->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredClassranges->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related PreferredSchooltypes') ?></h4>
    <?php if (!empty($partner->preferred_schooltypes)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Partner Id') ?></th>
            <th><?= __('Schooltype Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($partner->preferred_schooltypes as $preferredSchooltypes): ?>
        <tr>
            <td><?= h($preferredSchooltypes->id) ?></td>
            <td><?= h($preferredSchooltypes->partner_id) ?></td>
            <td><?= h($preferredSchooltypes->schooltype_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'PreferredSchooltypes', 'action' => 'view', $preferredSchooltypes->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'PreferredSchooltypes', 'action' => 'edit', $preferredSchooltypes->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PreferredSchooltypes', 'action' => 'delete', $preferredSchooltypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredSchooltypes->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related PreferredSubjects') ?></h4>
    <?php if (!empty($partner->preferred_subjects)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Subject Id') ?></th>
            <th><?= __('Partner Id') ?></th>
            <th><?= __('Maximum Class') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($partner->preferred_subjects as $preferredSubjects): ?>
        <tr>
            <td><?= h($preferredSubjects->id) ?></td>
            <td><?= h($preferredSubjects->subject_id) ?></td>
            <td><?= h($preferredSubjects->partner_id) ?></td>
            <td><?= h($preferredSubjects->maximum_class) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'PreferredSubjects', 'action' => 'view', $preferredSubjects->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'PreferredSubjects', 'action' => 'edit', $preferredSubjects->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PreferredSubjects', 'action' => 'delete', $preferredSubjects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredSubjects->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Tandems') ?></h4>
    <?php if (!empty($partner->tandems)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Partner Id') ?></th>
            <th><?= __('Student Id') ?></th>
            <th><?= __('Active') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($partner->tandems as $tandems): ?>
        <tr>
            <td><?= h($tandems->id) ?></td>
            <td><?= h($tandems->partner_id) ?></td>
            <td><?= h($tandems->student_id) ?></td>
            <td><?= h($tandems->active) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Tandems', 'action' => 'view', $tandems->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Tandems', 'action' => 'edit', $tandems->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tandems', 'action' => 'delete', $tandems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tandems->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div id="mapdiv"></div>

<script src="http://www.openlayers.org/api/OpenLayers.js"></script>

<script type="text/javascript" language="JavaScript">
 

    map = new OpenLayers.Map('mapdiv');  //create map at div with id=mapdiv
    map.addLayer(new OpenLayers.Layer.OSM());

    epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
    projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)

    var zoom=14;
    var center  = new OpenLayers.LonLat( 13.40495,52.52000 ).transform(epsg4326, projectTo);
    map.setCenter (center, zoom);  
</script>

