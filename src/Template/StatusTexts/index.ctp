<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <li><?= $this->Html->link(__('New Status Text'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="statusTexts index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('status_id') ?></th>
            <th><?= $this->Paginator->sort('text') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($statusTexts as $statusText): ?>
        <tr>
            <td><?= h($statusText->status->name) ?></td>
            <td><?= h($statusText->text) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $statusText->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $statusText->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $statusText->id], ['confirm' => __('Are you sure you want to delete # {0}?', $statusText->id)]) ?>
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
