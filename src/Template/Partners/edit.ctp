<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <?php if(isset($vermittler) or isset($locationAdmin) or isset($admin)) : ?>
            <li><?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $partner->id],
                            ['confirm' => __('Are you sure you want to delete # {0}?', $partner->id)]
                    )
            ?></li>
            <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?></li>
        <?php else: ?>
            <li><?=__('No Actions')?></li>
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
            echo ($type > 1) ? $this->Form->input('status_id', ['options' => $status, 'empty' => false, 'label' => __('Status')]) : '';
            echo $this->Form->input('age', ['value' => $partner->age, 'label' => __('age')]);
            echo $this->Form->input('sex', ['value' => $partner->sex, 'label' => __('Sex')]);
            echo $this->Form->input('degree_course', ['value' => $partner->degree_course, 'label' => __('degree_course')]);
            echo $this->Form->input('job', ['value' => $partner->job, 'label' => __('job')]);
            echo $this->Form->input('street', ['value' => $partner->street, 'label' => __('street')]);
            echo $this->Form->input('house_number', ['value' => $partner->house_number, 'label' => __('house_number')]);
            echo $this->Form->input('house_number_addition', ['value' => $partner->house_number_addition, 'label' => __('house_number_addition')]);
            echo $this->Form->input('postcode', ['value' => $partner->postcode, 'label' => __('postcode')]);
            echo $this->Form->input('city', ['value' => $partner->city, 'label' => __('city')]);
            echo $this->Form->input('telephone', ['value' => $partner->telephone, 'label' => __('telephone')]);
            echo $this->Form->input('mobile', ['value' => $partner->mobile, 'label' => __('mobile')]);
            echo $this->Form->input('teach_time', ['value' => $partner->teach_time, 'label' => __('teach_time')]);
            echo $this->Form->input('extra_time', ['value' => $partner->extra_time, 'label' => __('extra_time')]);
            echo $this->Form->input('spend_time', ['value' => $partner->spend_time, 'label' => __('spend_time')]);
            echo $this->Form->input('experience', ['value' => $partner->experience, 'label' => __('experience')]);
            echo $this->Form->label(__('preferred_gender'));
            echo $this->Form->select('preferred_gender', ['' => 'egal', 'm' => 'männlich', 'w' => 'weiblich']);
            echo $this->Form->input('support_wish', ['value' => $partner->support_wish, 'label' => __('support_wish')]);
            echo $this->Form->input('reason_for_decision', ['value' => $partner->reason_for_decision, 'label' => __('reason_for_decision')]);
            echo $this->Form->input('additional_informations', ['value' => $partner->additional_informations, 'label' => __('additional_informations')]);
            echo $this->Form->input('reason_for_schuelerpaten', ['value' => $partner->reason_for_schuelerpaten, 'label' => __('reason_for_schuelerpaten')]);
        ?>
    </fieldset>
    <?= $this->Html->link('Cancel', ['action' => 'view', $partner->id], ['class' => 'button', 'float' => 'right']); ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
