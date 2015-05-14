<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tandem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tandem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tandems'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="tandems form large-10 medium-9 columns">
    <?= $this->Form->create($tandem); ?>
    <fieldset>
        <legend><?= __('Edit Tandem') ?></legend>
        <?php
            echo $this->Form->input('partner_id', ['options' => $partners]);
            echo $this->Form->input('student_id', ['options' => $students]);
            echo $this->Form->input('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
