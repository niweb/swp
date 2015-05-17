<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Preferred Classrange'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classranges'), ['controller' => 'Classranges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classrange'), ['controller' => 'Classranges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="preferredClassranges index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('partner_id') ?></th>
            <th><?= $this->Paginator->sort('classrange_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($preferredClassranges as $preferredClassrange): ?>
        <tr>
            <td><?= $this->Number->format($preferredClassrange->id) ?></td>
            <td>
                <?= $preferredClassrange->has('partner') ? $this->Html->link($preferredClassrange->partner->name, ['controller' => 'Partners', 'action' => 'view', $preferredClassrange->partner->id]) : '' ?>
            </td>
            <td>
                <?= $preferredClassrange->has('classrange') ? $this->Html->link($preferredClassrange->classrange->name, ['controller' => 'Classranges', 'action' => 'view', $preferredClassrange->classrange->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $preferredClassrange->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $preferredClassrange->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $preferredClassrange->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredClassrange->id)]) ?>
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
