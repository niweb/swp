<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $statusHistory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $statusHistory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Status Historys'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="statusHistorys form large-10 medium-9 columns">
    <?= $this->Form->create($statusHistory); ?>
    <fieldset>
        <legend><?= __('Edit Status History') ?></legend>
        <?php
            echo $this->Form->input('partner_id', ['options' => $partners, 'empty' => true]);
            echo $this->Form->input('status_id');
            echo $this->Form->input('timestamp');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
