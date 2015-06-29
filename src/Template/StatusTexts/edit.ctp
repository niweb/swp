<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $statusText->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $statusText->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Status Texts'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="statusTexts form large-10 medium-9 columns">
    <?= $this->Form->create($statusText); ?>
    <fieldset>
        <legend><?= __('Edit Status Text') ?></legend>
        <?php
            echo $this->Form->textarea('text');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
