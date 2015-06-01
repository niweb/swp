<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <?php if(isset($matchmaker)) : ?>
			<li><?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->id]) ?> </li>
			<li><?= $this->Form->postLink(__('Delete Student'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?> </li>
			<li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Tandems'), ['controller' => 'Tandems', 'action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('New Tandem'), ['controller' => 'Tandems', 'action' => 'add']) ?></li>
		<?php endif; ?>
    </ul>
</div>
<div class="students view large-10 medium-9 columns">
    <h2><?= h($student->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($student->name) ?></p>
            <h6 class="subheader"><?= __('Lastname') ?></h6>
            <p><?= h($student->lastname) ?></p>
            <h6 class="subheader"><?= __('Telephone') ?></h6>
            <p><?= h($student->telephone) ?></p>
            <h6 class="subheader"><?= __('Mobile') ?></h6>
            <p><?= h($student->mobile) ?></p>
            <h6 class="subheader"><?= __('Location') ?></h6>
            <p><?= $student->has('location') ? $this->Html->link($student->location->name, ['controller' => 'Locations', 'action' => 'view', $student->location->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($student->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Tandems') ?></h4>
    <?php if (!empty($student->tandems)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Partner Id') ?></th>
            <th><?= __('Student Id') ?></th>
            <th><?= __('Active') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($student->tandems as $tandems): ?>
        <tr>
            <td><?= h($tandems->id) ?></td>
            <td><?= h($tandems->partner_id) ?></td>
            <td><?= h($tandems->student_id) ?></td>
            <td><?= h($tandems->active) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Tandems', 'action' => 'view', $tandems->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Tandems', 'action' => 'edit', $tandems->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tandems', 'action' => 'delete', $tandems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tandems->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
