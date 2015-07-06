<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <?php if(isset($matchmaker)): ?>
            <li><?= $this->Html->link(__('List Students'), ['action' => 'index', 'waiting']) ?> </li>
        <?php elseif(isset($vermittler) or isset($locationAdmin) or isset($admin)) : ?>
            <li><?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->id]) ?> </li>
			<?php if($student->student_status_id != 3) : ?>
				<li><?= $this->Html->link(__('Deactivate'), ['action' => 'deactivate', $student->id], ['confirm' => __('Are you sure you want to deactivate {0}?', h($student->first_name.' '.$student->last_name))]) ?></li>
			<?php else: ?>
				<li><?= $this->Html->link(__('Reactivate'), ['action' => 'reactivate', $student->id], ['confirm' => __('Are you sure you want to reactivate {0}?', h($student->first_name.' '.$student->last_name))]) ?></li>
				<?php if(isset($locationAdmin) or isset($admin)) : ?>
					<li><?= $this->Html->link(__('Delete'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete {0}?', h($student->first_name.' '.$student->last_name))]) ?></li>
				<?php endif; ?>
			<?php endif; ?>
            <li><?= $this->Html->link(__('Delete Student'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete {0}?', h($student->first_name.' '.$student->last_name))]) ?> </li>
            <li><?= $this->Html->link(__('List waiting Students'), ['controller' => 'Students', 'action' => 'index', 'waiting']) ?></li>
            <li><?= $this->Html->link(__('List active Students'), ['controller' => 'Students', 'action' => 'index', 'active']) ?></li>
            <li><?= $this->Html->link(__('List inactive Students'), ['controller' => 'Students', 'action' => 'index', 'inactive']) ?></li>
        <?php endif; ?>
    </ul>
</div>
<div class="students view large-10 medium-9 columns">
    <h2><?= h($student->first_name . ' ' . $student->last_name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Status') ?></h6>
            <p><?= h($student->student_status->name) ?></p>
            <h6 class="subheader"><?= __('sex') ?></h6>
            <p><?= (($student->sex)=='m') ? __('male') : __('female')?></p>
            <h6 class="subheader"><?= __('street') ?></h6>
            <p><?= h($student->street) ?></p>
            <h6 class="subheader"><?= __('house_number') ?></h6>
            <p><?= h($student->house_number) ?></p>
            <h6 class="subheader"><?= __('house_number_addition') ?></h6>
            <p><?= h($student->house_number_addition) ?></p>
            <h6 class="subheader"><?= __('postcode') ?></h6>
            <p><?= h($student->postcode) ?></p>
            <h6 class="subheader"><?= __('city') ?></h6>
            <p><?= h($student->city) ?></p>
            <h6 class="subheader"><?= __('telephone') ?></h6>
            <p><?= h($student->telephone) ?></p>
            <h6 class="subheader"><?= __('mobile') ?></h6>
            <p><?= h($student->mobile) ?></p>
			<h6 class="subheader"><?= __('Schooltype') ?></h6>
            <p><?= h($student->schooltype->name) ?></p>
			<h6 class="subheader"><?= __('Classrange') ?></h6>
            <p><?= h($classrange->classrange->name) ?></p>
			<h6 class="subheader"><?= __('Subjects') ?></h6>
            <p><?= (isset($subject1)) ? h($subject1->name) : '' ?></p>
            <p><?= (isset($subject2)) ? h($subject2->name) : '' ?></p>
            <p><?= (isset($subject3)) ? h($subject3->name) : '' ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Tandems') ?></h4>
    <?php if (!empty($student->tandems)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Partner') ?></th>
            <th><?= __('Activated') ?></th>
			<th><?= __('Deactivated') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($student->tandems as $tandems): ?>
        <tr>

            <td><?= $this->Html->link(h($tandems->partner->user->first_name.' '.$tandems->partner->user->last_name), ['controller' => 'Partners', 'action' => 'view', $tandems->partner->id]) ?></td>
            <td><?= h($tandems->activated) ?></td>
			<?php if($tandems->deactivated != NULL) : ?>
				<td><?= h($tandems->deactivated) ?></td>
			<?php else : ?>
				<td></td>
			<?php endif; ?>

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
