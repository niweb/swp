<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Status History'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="statusHistorys index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('partner_id') ?></th>
            <th><?= $this->Paginator->sort('status_id') ?></th>
            <th><?= $this->Paginator->sort('timestamp') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($statusHistorys as $statusHistory): ?>
        <tr>
            <td><?= $this->Number->format($statusHistory->id) ?></td>
            <td>
                <?= $statusHistory->has('partner') ? $this->Html->link($statusHistory->partner->first_name, ['controller' => 'Partners', 'action' => 'view', $statusHistory->partner->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($statusHistory->status_id) ?></td>
            <td><?= h($statusHistory->timestamp) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $statusHistory->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $statusHistory->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $statusHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $statusHistory->id)]) ?>
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
