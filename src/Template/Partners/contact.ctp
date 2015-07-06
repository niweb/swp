<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index', 'active']) ?></li>
    </ul>
</div> 
<div class="partners form large-10 medium-9 columns">
    <?= $this->Form->create($partner); ?>
    <fieldset>
        <legend><?= __('Edit Contact Person') ?></legend>
		<h2><?= h($partner->user->first_name) ?>
        <?= h($partner->user->last_name) ?></h2>
        <?php
            echo $this->Form->label(__('contact Person'));
            echo $this->Form->textarea('contact');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->button(__('Cancel'), ['type' => 'cancel', 'onclick' => 'window.history.go(-1)']) ?>
    <?= $this->Form->end() ?>
</div>