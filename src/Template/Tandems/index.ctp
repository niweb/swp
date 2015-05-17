<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Tandem'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="tandems index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('partner_id') ?></th>
            <th><?= $this->Paginator->sort('student_id') ?></th>
            <th><?= $this->Paginator->sort('active') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tandems as $tandem): ?>
        <tr>
            <td><?= $this->Number->format($tandem->id) ?></td>
            <td>
                <?= $tandem->has('partner') ? $this->Html->link($tandem->partner->name, ['controller' => 'Partners', 'action' => 'view', $tandem->partner->id]) : '' ?>
            </td>
            <td>
                <?= $tandem->has('student') ? $this->Html->link($tandem->student->name, ['controller' => 'Students', 'action' => 'view', $tandem->student->id]) : '' ?>
            </td>
            <td><?= h($tandem->active) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $tandem->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tandem->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tandem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tandem->id)]) ?>
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
