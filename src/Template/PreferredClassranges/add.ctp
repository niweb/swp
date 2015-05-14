<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Preferred Classranges'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classranges'), ['controller' => 'Classranges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classrange'), ['controller' => 'Classranges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="preferredClassranges form large-10 medium-9 columns">
    <?= $this->Form->create($preferredClassrange); ?>
    <fieldset>
        <legend><?= __('Add Preferred Classrange') ?></legend>
        <?php
            echo $this->Form->input('partner_id', ['options' => $partners]);
            echo $this->Form->input('classrange_id', ['options' => $classranges]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
