<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <?php if(isset($matchmaker) or isset($vermittler) or isset($locationAdmin) or isset($admin)) : ?>
            <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <?php else: ?>
            <li><?= __('No Actions')?></li>
        <?php endif; ?>
    </ul>
</div>
<div class="students index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('first_name', __('first_name')) ?></th>
            <th><?= $this->Paginator->sort('last_name', __('last_name')) ?></th>
            <th><?= $this->Paginator->sort('sex', __('sex')) ?></th>
            <th><?= $this->Paginator->sort('status_id', __('Status')) ?></th>
            <?php if(isset($admin)):?><th><?= $this->Paginator->sort('location_id', __('location_id')) ?></th><?php endif; ?>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= h($student->first_name) ?></td>
            <td><?= h($student->last_name) ?></td>
            <td><?= (($student->sex)=='m') ? __('male') : __('female')?></td>
            <td><?= h($student->student_status->name) ?></td>
            <?php if(isset($admin)): ?><td>
                <?= $student->has('location') ? $this->Html->link($student->location->name, ['controller' => 'Locations', 'action' => 'view', $student->location->id]) : '' ?>
            </td><?php endif; ?>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $student->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?>
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
