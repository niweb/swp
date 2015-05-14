<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Partner'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="partners index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('lastname') ?></th>
            <th><?= $this->Paginator->sort('age') ?></th>
            <th><?= $this->Paginator->sort('sex') ?></th>
            <th><?= $this->Paginator->sort('degree_course') ?></th>
            <th><?= $this->Paginator->sort('job') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($partners as $partner): ?>
        <tr>
            <td><?= $this->Number->format($partner->id) ?></td>
            <td><?= h($partner->name) ?></td>
            <td><?= h($partner->lastname) ?></td>
            <td><?= $this->Number->format($partner->age) ?></td>
            <td><?= h($partner->sex) ?></td>
            <td><?= h($partner->degree_course) ?></td>
            <td><?= h($partner->job) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $partner->partner_id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $partner->partner_id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partner->partner_id], ['confirm' => __('Are you sure you want to delete # {0}?', $partner->partner_id)]) ?>
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
