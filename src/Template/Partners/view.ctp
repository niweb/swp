<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Partner'), ['action' => 'edit', $partner->partner_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Partner'), ['action' => 'delete', $partner->partner_id], ['confirm' => __('Are you sure you want to delete # {0}?', $partner->partner_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="partners view large-10 medium-9 columns">
    <h2><?= h($partner->partner_id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $partner->has('user') ? $this->Html->link($partner->user->user_id, ['controller' => 'Users', 'action' => 'view', $partner->user->user_id]) : '' ?></p>
            <h6 class="subheader"><?= __('Student') ?></h6>
            <p><?= $partner->has('student') ? $this->Html->link($partner->student->student_id, ['controller' => 'Students', 'action' => 'view', $partner->student->student_id]) : '' ?></p>
            <h6 class="subheader"><?= __('Vorname') ?></h6>
            <p><?= h($partner->vorname) ?></p>
            <h6 class="subheader"><?= __('Nachname') ?></h6>
            <p><?= h($partner->nachname) ?></p>
            <h6 class="subheader"><?= __('Telefon') ?></h6>
            <p><?= h($partner->telefon) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Partner Id') ?></h6>
            <p><?= $this->Number->format($partner->partner_id) ?></p>
        </div>
    </div>
</div>
