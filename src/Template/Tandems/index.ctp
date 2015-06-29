<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <th><?= __('No Actions') ?></th>               
    </ul>
</div>
<div class="tandems index large-10 medium-9 columns">
	<h4><?= __('Active Tandems') ?></h4>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('partner_id') ?></th>
            <th><?= $this->Paginator->sort('student_id') ?></th>
            <th><?= $this->Paginator->sort('activated') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tandems as $tandem): ?>
        <?php if($tandem->deactivated == NULL) : ?>
            <tr>
                <td>
                    <?=/* $tandem->has('partner_id') ?*/ $this->Html->link(h($tandem->partner->user->first_name.' '.$tandem->partner->user->last_name), ['controller' => 'Partners', 'action' => 'view', $tandem->partner->id])/* : ''*/ ?>
                </td>
                <td>
                    <?=/* $tandem->has('student_id') ?*/ $this->Html->link(h($tandem->student->first_name.' '.$tandem->student->last_name), ['controller' => 'Students', 'action' => 'view', $tandem->student->id])/* : ''*/ ?>
                </td>
                <td><?= h($tandem->activated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tandem->id]) ?>
                    <?= $this->Html->link(__('Deactivate'), ['action' => 'deactivate', $tandem->id], ['confirm' => __('Are you sure you want to deactivate # {0}?', $tandem->id)]) ?>
                </td>
            </tr>
        <?php endif; ?>
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
	<h4><?= __('Inactive Tandems') ?></h4>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('partner_id') ?></th>
            <th><?= $this->Paginator->sort('student_id') ?></th>
            <th><?= $this->Paginator->sort('status_id') ?></th>
            <th><?= $this->Paginator->sort('activated') ?></th>
            <th><?= $this->Paginator->sort('deactivated') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tandems as $tandem): ?>
        <?php if($tandem->deactivated != NULL) : ?>
            <tr>
                <td>
                        <?= $tandem->has('partner') ? $this->Html->link(h($tandem->partner->user->first_name.' '.$tandem->partner->user->last_name), ['controller' => 'Partners', 'action' => 'view', $tandem->partner->id]) : '' ?>
                </td>
                <td>
                        <?= $tandem->has('student') ? $this->Html->link(h($tandem->student->first_name.' '.$tandem->student->last_name), ['controller' => 'Students', 'action' => 'view', $tandem->student->id]) : '' ?>
                </td>
                <td>
                        <?= $tandem->has('partner') ? $this->Html->link($tandem->partner->status_id, ['controller' => 'Partners', 'action' => 'view', $tandem->partner->id]) : '' ?>
                </td>
               
                <td><?= h($tandem->activated) ?></td>
                <td><?= h($tandem->deactivated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tandem->id]) ?>
                    <?php if (isset($locationAdmin)): ?>
                    <?= $this->Html->link(__('Reactivate'), ['action' => 'reactivate', $tandem->id], ['confirm' => __('Are you sure you want to reactivate # {0}?', $tandem->id)]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tandem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tandem->id)]) ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
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
