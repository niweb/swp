<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Student Classrange'), ['action' => 'edit', $studentClassrange->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student Classrange'), ['action' => 'delete', $studentClassrange->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentClassrange->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Student Classranges'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Classrange'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classranges'), ['controller' => 'Classranges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classrange'), ['controller' => 'Classranges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="studentClassranges view large-10 medium-9 columns">
    <h2><?= h($studentClassrange->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Student') ?></h6>
            <p><?= $studentClassrange->has('student') ? $this->Html->link($studentClassrange->student->first_name, ['controller' => 'Students', 'action' => 'view', $studentClassrange->student->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Classrange') ?></h6>
            <p><?= $studentClassrange->has('classrange') ? $this->Html->link($studentClassrange->classrange->name, ['controller' => 'Classranges', 'action' => 'view', $studentClassrange->classrange->id]) : '' ?></p>
        </div>
    </div>
</div>
