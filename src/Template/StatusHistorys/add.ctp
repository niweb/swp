<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Status Historys'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="statusHistorys form large-10 medium-9 columns">
    <?= $this->Form->create($statusHistory); ?>
    <fieldset>
        <legend><?= __('Add Status History') ?></legend>
        <?php
			if($currStatus != NULL){
				echo $this->Form->input('status_id', ['options' => $status, 'empty' => false, 'value' => $currStatus->status_id]);
				echo $this->Form->textarea('text', ['value' => $currStatus->text]);
			} else {
				echo $this->Form->input('status_id', ['options' => $status, 'empty' => false]);
				echo $this->Form->textarea('text');
			}
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
