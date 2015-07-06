<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Student Status'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="studentStatus form large-10 medium-9 columns">
    <?= $this->Form->create($studentStatus); ?>
    <fieldset>
        <legend><?= __('Add Student Status') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Cancel'), ['type' => 'cancel', 'onclick' => 'window.history.go(-1)']) ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
