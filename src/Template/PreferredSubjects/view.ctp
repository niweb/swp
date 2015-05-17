<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Preferred Subject'), ['action' => 'edit', $preferredSubject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Preferred Subject'), ['action' => 'delete', $preferredSubject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredSubject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Preferred Subjects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Preferred Subject'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="preferredSubjects view large-10 medium-9 columns">
    <h2><?= h($preferredSubject->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Subject') ?></h6>
            <p><?= $preferredSubject->has('subject') ? $this->Html->link($preferredSubject->subject->name, ['controller' => 'Subjects', 'action' => 'view', $preferredSubject->subject->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Partner') ?></h6>
            <p><?= $preferredSubject->has('partner') ? $this->Html->link($preferredSubject->partner->name, ['controller' => 'Partners', 'action' => 'view', $preferredSubject->partner->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($preferredSubject->id) ?></p>
            <h6 class="subheader"><?= __('Maximum Class') ?></h6>
            <p><?= $this->Number->format($preferredSubject->maximum_class) ?></p>
        </div>
    </div>
</div>
