<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Type'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="types index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($types as $type): ?>
        <tr>
            <td><?= $this->Number->format($type->id) ?></td>
            <td><?= h($type->name) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $type->type_id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $type->type_id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $type->type_id], ['confirm' => __('Are you sure you want to delete # {0}?', $type->type_id)]) ?>
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
