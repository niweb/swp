<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <?php if(isset($matchmaker)) : ?>
			<li><?= $this->Html->link(__('Edit Tandem'), ['action' => 'edit', $tandem->id]) ?> </li>
			<li><?= $this->Form->postLink(__('Delete Tandem'), ['action' => 'delete', $tandem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tandem->id)]) ?> </li>
			<li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Tandems'), ['controller' => 'Tandems', 'action' => 'index']) ?></li>
		<?php endif; ?>
    </ul>
</div>
<div class="tandems view large-10 medium-9 columns">
    <h2><?= h($tandem->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Partner') ?></h6>
            <p><?= $tandem->has('partner') ? $this->Html->link($tandem->partner->user->first_name, ['controller' => 'Partners', 'action' => 'view', $tandem->partner->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Student') ?></h6>
            <p><?= $tandem->has('student') ? $this->Html->link($tandem->student->first_name, ['controller' => 'Students', 'action' => 'view', $tandem->student->id]) : '' ?></p>
			<h6 class="subheader"><?= __('Activated') ?></h6>
			<p><?= h($tandem->activated) ?></p>
			<?php if($tandem->deactivated) : ?>
				<h6 class="subheader"><?= __('Deactivated') ?></h6>
				<p><?= h($tandem->activated) ?></p>
			<?php endif; ?>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($tandem->id) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Active') ?></h6>
            <p><?= $tandem->deactivated ? __('No') : __('Yes'); ?></p>
        </div>
    </div>
</div>
