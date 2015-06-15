<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Student Classrange'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classranges'), ['controller' => 'Classranges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classrange'), ['controller' => 'Classranges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="studentClassranges index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('student_id') ?></th>
            <th><?= $this->Paginator->sort('classrange_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($studentClassranges as $studentClassrange): ?>
        <tr>
            <td><?= $this->Number->format($studentClassrange->id) ?></td>
            <td>
                <?= $studentClassrange->has('student') ? $this->Html->link($studentClassrange->student->first_name, ['controller' => 'Students', 'action' => 'view', $studentClassrange->student->id]) : '' ?>
            </td>
            <td>
                <?= $studentClassrange->has('classrange') ? $this->Html->link($studentClassrange->classrange->name, ['controller' => 'Classranges', 'action' => 'view', $studentClassrange->classrange->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $studentClassrange->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $studentClassrange->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $studentClassrange->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentClassrange->id)]) ?>
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
