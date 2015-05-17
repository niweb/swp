<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Preferred Schooltype'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schooltypes'), ['controller' => 'Schooltypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schooltype'), ['controller' => 'Schooltypes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="preferredSchooltypes index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('partner_id') ?></th>
            <th><?= $this->Paginator->sort('schooltype_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($preferredSchooltypes as $preferredSchooltype): ?>
        <tr>
            <td><?= $this->Number->format($preferredSchooltype->id) ?></td>
            <td>
                <?= $preferredSchooltype->has('partner') ? $this->Html->link($preferredSchooltype->partner->name, ['controller' => 'Partners', 'action' => 'view', $preferredSchooltype->partner->id]) : '' ?>
            </td>
            <td>
                <?= $preferredSchooltype->has('schooltype') ? $this->Html->link($preferredSchooltype->schooltype->name, ['controller' => 'Schooltypes', 'action' => 'view', $preferredSchooltype->schooltype->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $preferredSchooltype->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $preferredSchooltype->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $preferredSchooltype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredSchooltype->id)]) ?>
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
