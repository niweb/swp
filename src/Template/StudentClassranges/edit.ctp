<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $studentClassrange->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $studentClassrange->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Student Classranges'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classranges'), ['controller' => 'Classranges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classrange'), ['controller' => 'Classranges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="studentClassranges form large-10 medium-9 columns">
    <?= $this->Form->create($studentClassrange); ?>
    <fieldset>
        <legend><?= __('Edit Student Classrange') ?></legend>
        <?php
            echo $this->Form->input('student_id', ['options' => $students, 'empty' => true]);
            echo $this->Form->input('classrange_id', ['options' => $classranges, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
