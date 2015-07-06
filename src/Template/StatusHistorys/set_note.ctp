<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
    </ul>
</div>
<div class="statusHistorys form large-10 medium-9 columns">
    <?= $this->Form->create($statusHistory); ?>
    <fieldset>
        <legend><?= __('Edit Status Note') ?></legend>
        <?php
            echo $this->Form->textarea('text', ['value', $statusHistory->text]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->button(__('Cancel'), ['type' => 'cancel', 'onclick' => 'window.history.go(-1)']) ?>
    <?= $this->Form->end() ?>
</div>
