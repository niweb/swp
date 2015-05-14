<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Classranges'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="classranges form large-10 medium-9 columns">
    <?= $this->Form->create($classrange); ?>
    <fieldset>
        <legend><?= __('Add Classrange') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
