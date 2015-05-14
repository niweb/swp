<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->student_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student'), ['action' => 'delete', $student->student_id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->student_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="students view large-10 medium-9 columns">
    <h2><?= h($student->student_id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($student->name) ?></p>
            <h6 class="subheader"><?= __('Lastname') ?></h6>
            <p><?= h($student->lastname) ?></p>
            <h6 class="subheader"><?= __('Telephone') ?></h6>
            <p><?= h($student->telephone) ?></p>
            <h6 class="subheader"><?= __('Mobile') ?></h6>
            <p><?= h($student->mobile) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($student->id) ?></p>
            <h6 class="subheader"><?= __('Location Id') ?></h6>
            <p><?= $this->Number->format($student->location_id) ?></p>
        </div>
    </div>
</div>
