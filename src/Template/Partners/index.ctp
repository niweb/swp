<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'register', $authUser['location_id']]) ?></li>
        
        <?php if(isset($vermittler) or isset($locationAdmin) OR isset($admin)): ?>
            <li><?= $this->Html->link(__('List verified Partners'), ['controller' => 'Partners', 'action' => 'index', 'verified']) ?></li>
            <li><?= $this->Html->link(__('List waiting and matched Partners'), ['controller' => 'Partners', 'action' => 'index', 'active']) ?></li>
            <li><?= $this->Html->link(__('List quit and denied Partners'), ['controller' => 'Partners', 'action' => 'index', 'inactive']) ?></li>
        <?php endif; ?>
            
    </ul>
</div>
<div class="partners index large-10 medium-9 columns">
    <?php if(count($partners->toArray()) > 0): ?>
        <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('Users.first_name', __('first_name')) ?></th>
                <th><?= $this->Paginator->sort('Users.last_name', __('last_name')) ?></th>
                <th><?= $this->Paginator->sort('age', __('age')) ?></th>
                <th><?= $this->Paginator->sort('sex', __('Sex')) ?></th>
                <th><?= $this->Paginator->sort('status_id', __('Status')) ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($partners as $partner): ?>
            <tr>
                <td><?= h($partner->user->first_name) ?></td>
                <td><?= h($partner->user->last_name) ?></td>
                <td><?= $this->Number->format($partner->age) ?></td>
                <td><?= (($partner->sex)=='m') ? __('male') : __('female')?></td>
                <td><?= h($partner->status->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $partner->id]) ?>
                    <br>
                    <?php if(($partner->status_id > 1) AND ($partner->status_id < 7)) : ?>
                        <?= $this->Html->link(__('Match'), ['action' => 'match', $partner->id]) ?>
                        <br>
                    <?php endif; ?>
                    <?php if(!isset($matchmaker)) : ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $partner->id]) ?>
                        <br>
                        <?= $this->Html->link(__('Edit Contact Person'), ['action' => 'contact', $partner->id]) ?>
                        <br>
                        <?php if(($partner->status_id > 1) and ($partner->status_id < 6)) : ?>
                            <?= $this->Html->link(__('Change Status'), ['action' => 'status', $partner->id]) ?>
                            <br>
                        <?php endif; ?>
                        
                        <?php if(($partner->status_id > 1) AND ($partner->status_id < 7)) : ?>
                            <?= $this->Form->postLink(__('Deactivate'), ['action' => 'deactivate', $partner->id], ['confirm' => __('Are you sure you want to deactivate {0}?', h($partner->user->first_name.' '.$partner->user->last_name))]) ?>
                            <br>
                        <?php elseif($partner->status_id >= 7): ?>
                            <?php if(isset($locationAdmin) or isset($admin)) : ?>
                                <?= $this->Form->postLink(__('Reactivate'), ['action' => 'reactivate', $partner->id], ['confirm' => __('Are you sure you want to reactivate {0}?', h($partner->user->first_name.' '.$partner->user->last_name))]) ?>
                                <br>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partner->id], ['confirm' => __('Are you sure you want to delete {0}?', h($partner->user->first_name.' '.$partner->user->last_name))]) ?>
                                <br>
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
    <?php else: echo '<br>'.__('no {0} to display', __('{0} Partners', __($view)));
    endif; ?>
</div>
