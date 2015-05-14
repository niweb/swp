<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Student'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="students index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('lastname') ?></th>
            <th><?= $this->Paginator->sort('telephone') ?></th>
            <th><?= $this->Paginator->sort('mobile') ?></th>
            <th><?= $this->Paginator->sort('location_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $this->Number->format($student->id) ?></td>
            <td><?= h($student->name) ?></td>
            <td><?= h($student->lastname) ?></td>
            <td><?= h($student->telephone) ?></td>
            <td><?= h($student->mobile) ?></td>
            <td><?= $this->Number->format($student->location_id) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $student->student_id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->student_id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->student_id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->student_id)]) ?>
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
