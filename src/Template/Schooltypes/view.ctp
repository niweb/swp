<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Schooltype'), ['action' => 'edit', $schooltype->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Schooltype'), ['action' => 'delete', $schooltype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schooltype->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Schooltypes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schooltype'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="schooltypes view large-10 medium-9 columns">
    <h2><?= h($schooltype->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($schooltype->name) ?></p>
            <h6 class="subheader"><?= __('Location') ?></h6>
            <p><?= $schooltype->has('location') ? $this->Html->link($schooltype->location->name, ['controller' => 'Locations', 'action' => 'view', $schooltype->location->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($schooltype->id) ?></p>
            <h6 class="subheader"><?= __('Maximum Class') ?></h6>
            <p><?= $this->Number->format($schooltype->maximum_class) ?></p>
            <h6 class="subheader"><?= __('Minimum Class') ?></h6>
            <p><?= $this->Number->format($schooltype->minimum_class) ?></p>
        </div>
    </div>
</div>
