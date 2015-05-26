<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New User Has Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="userHasTypes index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('type_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($userHasTypes as $userHasType): ?>
        <tr>
            <td><?= $this->Number->format($userHasType->id) ?></td>
            <td>
                <?= $userHasType->has('user') ? $this->Html->link($userHasType->user->id, ['controller' => 'Users', 'action' => 'view', $userHasType->user->id]) : '' ?>
            </td>
            <td>
                <?= $userHasType->has('type') ? $this->Html->link($userHasType->type->name, ['controller' => 'Types', 'action' => 'view', $userHasType->type->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $userHasType->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userHasType->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userHasType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userHasType->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
