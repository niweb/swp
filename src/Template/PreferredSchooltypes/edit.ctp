<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $preferredSchooltype->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $preferredSchooltype->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Preferred Schooltypes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schooltypes'), ['controller' => 'Schooltypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schooltype'), ['controller' => 'Schooltypes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="preferredSchooltypes form large-10 medium-9 columns">
    <?= $this->Form->create($preferredSchooltype); ?>
    <fieldset>
        <legend><?= __('Edit Preferred Schooltype') ?></legend>
        <?php
            echo $this->Form->input('partner_id', ['options' => $partners]);
            echo $this->Form->input('schooltype_id', ['options' => $schooltypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
