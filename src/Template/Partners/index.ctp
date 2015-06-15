<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
		
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'register']) ?></li>
                
    </ul>
</div>
<div class="partners index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id', __('Id')) ?></th>
            <th><?= $this->Paginator->sort('Users.first_name', __('first_name')) ?></th>
            <th><?= $this->Paginator->sort('Users.last_name', __('last_name')) ?></th>
            <th><?= $this->Paginator->sort('age', __('age')) ?></th>
            <th><?= $this->Paginator->sort('sex', __('Sex')) ?></th>
            <th><?= $this->Paginator->sort('degree_course', __('degree_course')) ?></th>
            <th><?= $this->Paginator->sort('job', __('job')) ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($partners as $partner): ?>
        <tr>
            <td><?= $this->Number->format($partner->id) ?></td>
            <td><?= h($partner->user->first_name) ?></td>
            <td><?= h($partner->user->last_name) ?></td>
            <td><?= $this->Number->format($partner->age) ?></td>
            <td><?= h($partner->sex) ?></td>
            <td><?= h($partner->degree_course) ?></td>
            <td><?= h($partner->job) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Match'), ['action' => 'match', $partner->id]) ?>
                <?= $this->Html->link(__('View'), ['action' => 'view', $partner->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $partner->id]) ?>
				<?= $this->Html->link(__('Status'), ['action' => 'status', $partner->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partner->id], ['confirm' => __('Are you sure you want to delete {0}?', h($partner->user->first_name.' '.$partner->user->last_name))]) ?>
                <?= $this->Html->link(__('Choose'), ['action' => 'choose_students', $partner->id]) ?>
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
