<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Student Status'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="studentStatus index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($studentStatus as $studentStatus): ?>
        <tr>
            <td><?= $this->Number->format($studentStatus->id) ?></td>
            <td><?= h($studentStatus->name) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $studentStatus->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $studentStatus->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $studentStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentStatus->id)]) ?>
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