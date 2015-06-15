<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
		<li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <!--
		<li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
		-->
    </ul>
</div>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
			echo $this->Form->input(__('first_name'));
			echo $this->Form->input(__('last_name'));
            echo $this->Form->input(__('email'));
            echo $this->Form->input(__('password'));
            echo $this->Form->input(__('type_id'), ['options' => $types, 'empty' => false]);
            echo $this->Form->input(__('location_id'), ['options' => $locations, 'empty' => false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
