<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Preferred Classrange'), ['action' => 'edit', $preferredClassrange->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Preferred Classrange'), ['action' => 'delete', $preferredClassrange->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredClassrange->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Preferred Classranges'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Preferred Classrange'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classranges'), ['controller' => 'Classranges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classrange'), ['controller' => 'Classranges', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="preferredClassranges view large-10 medium-9 columns">
    <h2><?= h($preferredClassrange->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Partner') ?></h6>
            <p><?= $preferredClassrange->has('partner') ? $this->Html->link($preferredClassrange->partner->name, ['controller' => 'Partners', 'action' => 'view', $preferredClassrange->partner->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Classrange') ?></h6>
            <p><?= $preferredClassrange->has('classrange') ? $this->Html->link($preferredClassrange->classrange->name, ['controller' => 'Classranges', 'action' => 'view', $preferredClassrange->classrange->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($preferredClassrange->id) ?></p>
        </div>
    </div>
</div>
