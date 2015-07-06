<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <li><?= ($active) ?
            $this->Html->link(h(__('List inactive Tandems')), ['action' => 'index', 'inactive']) :
            $this->Html->link(h(__('List active Tandems')), ['action' => 'index', 'active']); ?>
    </ul>
</div>
<div class="tandems index large-10 medium-9 columns">
    <h4><?= ($active) ? __('Active Tandems') : __('Inactive Tandems')?></h4>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('Users.first_name', 'Partner') ?></th>
            <th><?= $this->Paginator->sort('Students.first_name', 'Student') ?></th>
            <th><?= $this->Paginator->sort('activated') ?></th>
            <?= ($active) ? '' : '<th>'.$this->Paginator->sort('deactivated').'</th>' ?>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tandems as $tandem): ?>
            <tr>
                <td>
                    <?=/* $tandem->has('partner_id') ?*/ $this->Html->link(h($tandem->partner->user->first_name.' '.$tandem->partner->user->last_name), ['controller' => 'Partners', 'action' => 'view', $tandem->partner->id])/* : ''*/ ?>
                </td>
                <td>
                    <?=/* $tandem->has('student_id') ?*/ $this->Html->link(h($tandem->student->first_name.' '.$tandem->student->last_name), ['controller' => 'Students', 'action' => 'view', $tandem->student->id])/* : ''*/ ?>
                </td>
                <td><?= h($tandem->activated) ?></td>
                <?= ($active) ? '' : '<td>'.h($tandem->deactivated).'</td>' ?>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tandem->id]) ?>
                    
                    <?php if($active): ?>
                    <?= $this->Html->link(__('Deactivate'), ['action' => 'deactivate', $tandem->id], ['confirm' => __('Are you sure you want to deactivate # {0}?', $tandem->id)]) ?>
                    <?php else:
                        if (!(isset($macthmaker))) : ?>
                            <?= $this->Html->link(__('Reactivate'), ['action' => 'reactivate', $tandem->id], ['confirm' => __('Are you sure you want to reactivate # {0}?', $tandem->id)]) ?>
                            <br>
                        <?php endif; ?>
                        <?php if (isset($locationAdmin) OR isset($admin)): ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tandem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tandem->id)]) ?>
                        <br>
                        <?php endif;
                    endif; ?>
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
