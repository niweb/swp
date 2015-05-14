<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Preferred Subject'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="preferredSubjects index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('subject_id') ?></th>
            <th><?= $this->Paginator->sort('partner_id') ?></th>
            <th><?= $this->Paginator->sort('not_an_option') ?></th>
            <th><?= $this->Paginator->sort('maximum_class') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($preferredSubjects as $preferredSubject): ?>
        <tr>
            <td><?= $this->Number->format($preferredSubject->id) ?></td>
            <td>
                <?= $preferredSubject->has('subject') ? $this->Html->link($preferredSubject->subject->name, ['controller' => 'Subjects', 'action' => 'view', $preferredSubject->subject->id]) : '' ?>
            </td>
            <td>
                <?= $preferredSubject->has('partner') ? $this->Html->link($preferredSubject->partner->partner_id, ['controller' => 'Partners', 'action' => 'view', $preferredSubject->partner->partner_id]) : '' ?>
            </td>
            <td><?= h($preferredSubject->not_an_option) ?></td>
            <td><?= $this->Number->format($preferredSubject->maximum_class) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $preferredSubject->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $preferredSubject->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $preferredSubject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredSubject->id)]) ?>
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
