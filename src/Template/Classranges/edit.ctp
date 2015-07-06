<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $classrange->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $classrange->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('View Classrange'), ['action' => 'view', $classrange->id]) ?></li>
        <li><?= $this->Html->link(__('List Classranges'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="classranges form large-10 medium-9 columns">
    <?= $this->Form->create($classrange); ?>
    <fieldset>
        <legend><?= __('Edit Classrange') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->button(__('Cancel'), ['type' => 'cancel', 'onclick' => 'window.history.go(-1)']) ?>
    <?= $this->Form->end() ?>
</div>
