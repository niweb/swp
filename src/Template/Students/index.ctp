<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <?php if(isset($matchmaker)): ?>
            <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index', 'waiting']) ?></li>
        <?php elseif(isset($vermittler) or isset($locationAdmin) or isset($admin)) : ?>
            <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List waiting Students'), ['controller' => 'Students', 'action' => 'index', 'waiting']) ?></li>
            <li><?= $this->Html->link(__('List active Students'), ['controller' => 'Students', 'action' => 'index', 'active']) ?></li>
            <li><?= $this->Html->link(__('List inactive Students'), ['controller' => 'Students', 'action' => 'index', 'deactive']) ?></li>
        <?php else: ?>
            <li><?= __('No Actions')?></li>
        <?php endif; ?>
    </ul>
</div>
<div class="search">
    <table><tr><td>
	<?= $this->Form->create(); ?>
	<?= $this->Form->input('search', ['label' => false]); ?>
            </td><td>
	<?= $this->Form->select('field', ['Vorname', 'Nachname', 'Geschlecht', 'Straße', 'PLZ', 'Stadt', 'Status']); ?>
            </td><td>
	<?= $this->Form->button(__('search'))?>
	<?= $this->Form->end()?>
    </td></tr></table>
</div>
<div class="students index large-10 medium-9 columns">
    <?php if(count($students->toArray()) > 0): ?>
        <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('first_name', __('first_name')) ?></th>
                <th><?= $this->Paginator->sort('last_name', __('last_name')) ?></th>
                <th><?= $this->Paginator->sort('sex', __('sex')) ?></th>
                <th><?= $this->Paginator->sort('student_status_id', __('Status')) ?></th>
                <?php if(isset($admin)):?><th><?= $this->Paginator->sort('location_id', __('Location')) ?></th><?php endif; ?>
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
                    <?php if(!isset($matchmaker)) : ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->id]) ?>
                        <?php if($student->student_status_id != 3) : ?>
                            <?= $this->Form->postLink(__('Deactivate'), ['action' => 'deactivate', $student->id], ['confirm' => __('Are you sure you want to deactivate # {0}?', $student->id)]) ?>
                        <?php else: ?>
                            <?= $this->Form->postLink(__('Reactivate'), ['action' => 'reactivate', $student->id], ['confirm' => __('Are you sure you want to reactivate # {0}?', $student->id)]) ?>
                            <?php if(isset($locationAdmin) or isset($admin)) : ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
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
    <?php else: echo '<br>'.__('no {0} to display', __('Students'));
    endif; ?>
</div>
