<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <?php if(isset($matchmaker)) : ?>
			<li><?= $this->Form->postLink(
					__('Delete'),
					['action' => 'delete', $partner->id],
					['confirm' => __('Are you sure you want to delete # {0}?', $partner->id)]
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
<div class="partners form large-10 medium-9 columns">
    <?= $this->Form->create($partner); ?>
    <fieldset>
        <legend><?= __('Edit Partner') ?></legend>
        <?php
            echo $this->Form->input('user.first_name', ['value' => $user->first_name, 'label' => __('first_name')]);
            echo $this->Form->input('user.last_name', ['value' => $user->last_name, 'label' => __('last_name')]);
            echo ($type > 1) ? $this->Form->input('status_id', ['options' => $status, 'empty' => false, 'label' => __('status')]) : '';
            echo $this->Form->input(__('age'), ['value' => $partner->age, 'label' => __('age')]);
            echo $this->Form->input(__('sex'), ['value' => $partner->sex, 'label' => __('sex')]);
            echo $this->Form->input(__('degree_course'), ['value' => $partner->degree_course, 'label' => __('degree_course')]);
            echo $this->Form->input(__('job'), ['value' => $partner->job, 'label' => __('job')]);
            echo $this->Form->input(__('street'), ['value' => $partner->street, 'label' => __('street')]);
            echo $this->Form->input(__('house_number'), ['value' => $partner->house_number, 'label' => __('house_number')]);
            echo $this->Form->input(__('house_number_addition'), ['value' => $partner->house_number_addition, 'label' => __('house_number_addition')]);
            echo $this->Form->input(__('postcode'), ['value' => $partner->postcode, 'label' => __('postcode')]);
            echo $this->Form->input(__('city'), ['value' => $partner->city, 'label' => __('city')]);
            echo $this->Form->input(__('telephone'), ['value' => $partner->telephone, 'label' => __('telephone')]);
            echo $this->Form->input(__('mobile'), ['value' => $partner->mobile, 'label' => __('mobile')]);
            echo $this->Form->input(__('teach_time'), ['value' => $partner->teach_time, 'label' => __('teach_time')]);
            echo $this->Form->input(__('extra_time'), ['value' => $partner->extra_time, 'label' => __('extra_time')]);
            echo $this->Form->input(__('spend_time'), ['value' => $partner->spend_time, 'label' => __('spend_time')]);
            echo $this->Form->input(__('experience'), ['value' => $partner->experience, 'label' => __('experience')]);
            echo $this->Form->label(__('preferred_gender'));
            echo $this->Form->select('preferred_gender', ['' => 'egal', 'm' => 'männlich', 'w' => 'weiblich']);
            echo $this->Form->input(__('support_wish'), ['value' => $partner->support_wish, 'label' => __('support_wish')]);
            echo $this->Form->input(__('reason_for_decision'), ['value' => $partner->reason_for_decision, 'label' => __('reason_for_decision')]);
            echo $this->Form->input(__('additional_informations'), ['value' => $partner->additional_informations, 'label' => __('additional_informations')]);
            echo $this->Form->input(__('reason_for_schuelerpaten'), ['value' => $partner->reason_for_schuelerpaten, 'label' => __('reason_for_schuelerpaten')]);
        ?>
    </fieldset>
    <?= $this->Html->link('Cancel', ['action' => 'view', $partner->id], ['class' => 'button', 'float' => 'right']); ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
