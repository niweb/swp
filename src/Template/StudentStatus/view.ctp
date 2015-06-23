<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Student Status'), ['action' => 'edit', $studentStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student Status'), ['action' => 'delete', $studentStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Student Status'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Status'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="studentStatus view large-10 medium-9 columns">
    <h2><?= h($studentStatus->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($studentStatus->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($studentStatus->id) ?></p>
        </div>
    </div>
</div>
