<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Student Subject'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="studentSubjects index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('student_id') ?></th>
            <th><?= $this->Paginator->sort('subject_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($studentSubjects as $studentSubject): ?>
        <tr>
            <td><?= $this->Number->format($studentSubject->id) ?></td>
            <td>
                <?= $studentSubject->has('student') ? $this->Html->link($studentSubject->student->first_name, ['controller' => 'Students', 'action' => 'view', $studentSubject->student->id]) : '' ?>
            </td>
            <td>
                <?= $studentSubject->has('subject') ? $this->Html->link($studentSubject->subject->name, ['controller' => 'Subjects', 'action' => 'view', $studentSubject->subject->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $studentSubject->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $studentSubject->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $studentSubject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentSubject->id)]) ?>
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
