<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <?php if(isset($vermittler) or isset($locationAdmin) or isset($admin)) : ?>
            <li><?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Student'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?> </li>
            <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?> </li>
        <?php endif; ?>
    </ul>
</div>
<div class="students view large-10 medium-9 columns">
    <h2><?= h($student->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('first_name') ?></h6>
            <p><?= h($student->first_name) ?></p>
            <h6 class="subheader"><?= __('last_name') ?></h6>
            <p><?= h($student->last_name) ?></p>
            <h6 class="subheader"><?= __('sex') ?></h6>
            <p><?= h($student->sex) ?></p>
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
            <h6 class="subheader"><?= __('lat') ?></h6>
            <p><?= h($student->lat) ?></p>
            <h6 class="subheader"><?= __('lng') ?></h6>
            <p><?= h($student->lng) ?></p>
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
            <td><?= h($tandems->activated) ?></td>
			<?php if($tandems->deactivated != NULL) : ?>
				<td><?= h($tandems->deactivated) ?></td>
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
