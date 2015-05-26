<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit User Has Type'), ['action' => 'edit', $userHasType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Has Type'), ['action' => 'delete', $userHasType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userHasType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Has Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Has Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="userHasTypes view large-10 medium-9 columns">
    <h2><?= h($userHasType->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $userHasType->has('user') ? $this->Html->link($userHasType->user->id, ['controller' => 'Users', 'action' => 'view', $userHasType->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Type') ?></h6>
            <p><?= $userHasType->has('type') ? $this->Html->link($userHasType->type->name, ['controller' => 'Types', 'action' => 'view', $userHasType->type->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($userHasType->id) ?></p>
        </div>
    </div>
</div>
