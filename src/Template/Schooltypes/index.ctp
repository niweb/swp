<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Schooltype'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="schooltypes index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('maximum_class') ?></th>
            <th><?= $this->Paginator->sort('minimum_class') ?></th>
            <th><?= $this->Paginator->sort('location_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($schooltypes as $schooltype): ?>
        <tr>
            <td><?= $this->Number->format($schooltype->id) ?></td>
            <td><?= h($schooltype->name) ?></td>
            <td><?= $this->Number->format($schooltype->maximum_class) ?></td>
            <td><?= $this->Number->format($schooltype->minimum_class) ?></td>
            <td>
                <?= $schooltype->has('location') ? $this->Html->link($schooltype->location->name, ['controller' => 'Locations', 'action' => 'view', $schooltype->location->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $schooltype->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $schooltype->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $schooltype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schooltype->id)]) ?>
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
