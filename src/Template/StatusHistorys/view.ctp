<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Status History'), ['action' => 'edit', $statusHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Status History'), ['action' => 'delete', $statusHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $statusHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Status Historys'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status History'), ['controller' => 'StatusHistorys', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="statusHistorys view large-10 medium-9 columns">
    <h2><?= h($statusHistory->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Partner') ?></h6>
            <p><?= $statusHistory->has('partner') ? $this->Html->link($statusHistory->partner->first_name, ['controller' => 'Partners', 'action' => 'view', $statusHistory->partner->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($statusHistory->id) ?></p>
            <h6 class="subheader"><?= __('Status Id') ?></h6>
            <p><?= $this->Number->format($statusHistory->status_id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Timestamp') ?></h6>
            <p><?= h($statusHistory->timestamp) ?></p>
        </div>
    </div>
</div>
