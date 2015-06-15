<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
		<li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Tandems'), ['controller' => 'Tandems', 'action' => 'index']) ?></li>
    </ul>
</div> 
<div class="partners form large-10 medium-9 columns">
    <?= $this->Form->create($partner); ?>
    <fieldset>
        <legend><?= __('Edit Partner') ?></legend>
		<h2><?= h($partner->user->first_name) ?>
        <?= h($partner->user->last_name) ?></h2>
        <?php
            echo $this->Form->input('status_id', ['options' => $status, 'empty' => false, 'label' => __('status_id')]);
			echo $this->Form->label(__('status_text'));
            echo $this->Form->textarea('status_text');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
