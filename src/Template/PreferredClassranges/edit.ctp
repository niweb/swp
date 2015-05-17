<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $preferredClassrange->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $preferredClassrange->id)]
            )
        ?></li>
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
        <legend><?= __('Edit Preferred Classrange') ?></legend>
        <?php
            echo $this->Form->input('partner_id', ['options' => $partners, 'empty' => true]);
            echo $this->Form->input('classrange_id', ['options' => $classranges, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
