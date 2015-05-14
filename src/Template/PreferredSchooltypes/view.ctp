<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Preferred Schooltype'), ['action' => 'edit', $preferredSchooltype->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Preferred Schooltype'), ['action' => 'delete', $preferredSchooltype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredSchooltype->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Preferred Schooltypes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Preferred Schooltype'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schooltypes'), ['controller' => 'Schooltypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schooltype'), ['controller' => 'Schooltypes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="preferredSchooltypes view large-10 medium-9 columns">
    <h2><?= h($preferredSchooltype->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Partner') ?></h6>
            <p><?= $preferredSchooltype->has('partner') ? $this->Html->link($preferredSchooltype->partner->partner_id, ['controller' => 'Partners', 'action' => 'view', $preferredSchooltype->partner->partner_id]) : '' ?></p>
            <h6 class="subheader"><?= __('Schooltype') ?></h6>
            <p><?= $preferredSchooltype->has('schooltype') ? $this->Html->link($preferredSchooltype->schooltype->name, ['controller' => 'Schooltypes', 'action' => 'view', $preferredSchooltype->schooltype->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($preferredSchooltype->id) ?></p>
        </div>
    </div>
</div>
