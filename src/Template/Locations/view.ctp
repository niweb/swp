<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Location'), ['action' => 'edit', $location->location_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Location'), ['action' => 'delete', $location->location_id], ['confirm' => __('Are you sure you want to delete # {0}?', $location->location_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="locations view large-10 medium-9 columns">
    <h2><?= h($location->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($location->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($location->id) ?></p>
        </div>
    </div>
</div>
