<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
		<?php if(isset($locationAdmin) OR isset($admin)) : ?>
			<li><?= $this->Html->link(__('New User'), ['action' => 'add']); ?></li>
		<?php else : ?>
			<li><?= __('No Actions') ?></li>
		<?php endif; ?>
    </ul>
</div>
<div class="users index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('first_name', __('first_name')) ?></th>
            <th><?= $this->Paginator->sort('last_name', __('last_name')) ?></th>
            <th><?= $this->Paginator->sort('email', __('email')) ?></th>
            <th><?= $this->Paginator->sort('created', __('created')) ?></th>
            <?php if(isset($admin)):?> <th><?= $this->Paginator->sort('location_id', __('Location')) ?></th><?php endif; ?>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->first_name ?></td>
            <td><?= $user->last_name ?></td>
            <td><?= h($user->email) ?></td>
            <td><?= h($user->created) ?></td>
            <?php if(isset($admin)):?> 
                <td>
                    <?= $user->has('location') ? $this->Html->link($user->location->name, ['controller' => 'Locations', 'action' => 'view', $user->location->id]) : '' ?>
                </td>
            <?php endif; ?>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
