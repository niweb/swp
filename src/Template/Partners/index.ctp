<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Partner'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="partners index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('partner_id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('student_id') ?></th>
            <th><?= $this->Paginator->sort('vorname') ?></th>
            <th><?= $this->Paginator->sort('nachname') ?></th>
            <th><?= $this->Paginator->sort('telefon') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($partners as $partner): ?>
        <tr>
            <td><?= $this->Number->format($partner->partner_id) ?></td>
            <td>
                <?= $partner->has('user') ? $this->Html->link($partner->user->user_id, ['controller' => 'Users', 'action' => 'view', $partner->user->user_id]) : '' ?>
            </td>
            <td>
                <?= $partner->has('student') ? $this->Html->link($partner->student->student_id, ['controller' => 'Students', 'action' => 'view', $partner->student->student_id]) : '' ?>
            </td>
            <td><?= h($partner->vorname) ?></td>
            <td><?= h($partner->nachname) ?></td>
            <td><?= h($partner->telefon) ?></td>
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
