<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->student_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student'), ['action' => 'delete', $student->student_id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->student_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="students view large-10 medium-9 columns">
    <h2><?= h($student->student_id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Location') ?></h6>
            <p><?= $student->has('location') ? $this->Html->link($student->location->name, ['controller' => 'Locations', 'action' => 'view', $student->location->location_id]) : '' ?></p>
            <h6 class="subheader"><?= __('Vorname') ?></h6>
            <p><?= h($student->vorname) ?></p>
            <h6 class="subheader"><?= __('Nachname') ?></h6>
            <p><?= h($student->nachname) ?></p>
            <h6 class="subheader"><?= __('Telefon') ?></h6>
            <p><?= h($student->telefon) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Student Id') ?></h6>
            <p><?= $this->Number->format($student->student_id) ?></p>
        </div>
    </div>
</div>
