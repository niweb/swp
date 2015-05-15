<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $preferredSubject->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $preferredSubject->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Preferred Subjects'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="preferredSubjects form large-10 medium-9 columns">
    <?= $this->Form->create($preferredSubject); ?>
    <fieldset>
        <legend><?= __('Edit Preferred Subject') ?></legend>
        <?php
            echo $this->Form->input('subject_id', ['options' => $subjects]);
            echo $this->Form->input('partner_id', ['options' => $partners]);
            echo $this->Form->input('maximum_class');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
