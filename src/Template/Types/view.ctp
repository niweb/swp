<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Type'), ['action' => 'edit', $type->type_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Type'), ['action' => 'delete', $type->type_id], ['confirm' => __('Are you sure you want to delete # {0}?', $type->type_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="types view large-10 medium-9 columns">
    <h2><?= h($type->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($type->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($type->id) ?></p>
        </div>
    </div>
</div>
