<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $partner->partner_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $partner->partner_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="partners form large-10 medium-9 columns">
    <?= $this->Form->create($partner); ?>
    <fieldset>
        <legend><?= __('Edit Partner') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('student_id', ['options' => $students, 'empty' => true]);
            echo $this->Form->input('vorname');
            echo $this->Form->input('nachname');
            echo $this->Form->input('telefon');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
