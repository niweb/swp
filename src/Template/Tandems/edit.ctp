<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <?php if(isset($matchmaker)) : ?>
			<li><?= $this->Form->postLink(
					__('Delete'),
					['action' => 'delete', $tandem->id],
					['confirm' => __('Are you sure you want to delete # {0}?', $tandem->id)]
				)
			?></li>
			<li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Tandems'), ['controller' => 'Tandems', 'action' => 'index']) ?></li>
		<?php endif; ?>
    </ul>
</div>
<div class="tandems form large-10 medium-9 columns">
    <?= $this->Form->create($tandem); ?>
    <fieldset>
        <legend><?= __('Edit Tandem') ?></legend>
        <?php
            echo $this->Form->input('partner_id', ['options' => $partners, 'empty' => true]);
            echo $this->Form->input('student_id', ['options' => $students, 'empty' => true]);
            echo $this->Form->input('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->button(__('Cancel'), ['type' => 'cancel', 'onclick' => 'window.history.go(-1)']) ?>
    <?= $this->Form->end() ?>
</div>
