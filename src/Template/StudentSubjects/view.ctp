<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Student Subject'), ['action' => 'edit', $studentSubject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student Subject'), ['action' => 'delete', $studentSubject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentSubject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Student Subjects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Subject'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="studentSubjects view large-10 medium-9 columns">
    <h2><?= h($studentSubject->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Student') ?></h6>
            <p><?= $studentSubject->has('student') ? $this->Html->link($studentSubject->student->first_name, ['controller' => 'Students', 'action' => 'view', $studentSubject->student->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Subject') ?></h6>
            <p><?= $studentSubject->has('subject') ? $this->Html->link($studentSubject->subject->name, ['controller' => 'Subjects', 'action' => 'view', $studentSubject->subject->id]) : '' ?></p>
        </div>
    </div>
</div>
