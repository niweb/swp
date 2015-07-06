<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <?php if(isset($vermittler) or isset($locationAdmin) or isset($admin) ) : ?>
            <?php if($student->student_status_id != 3) : ?>
				<li><?= $this->Html->link(__('Deactivate'), ['action' => 'deactivate', $student->id], ['confirm' => __('Are you sure you want to deactivate # {0}?', $student->id)]) ?></li>
			<?php else: ?>
				<li><?= $this->Html->link(__('Reactivate'), ['action' => 'reactivate', $student->id], ['confirm' => __('Are you sure you want to reactivate # {0}?', $student->id)]) ?></li>
				<?php if(isset($locationAdmin) or isset($admin)) : ?>
					<li><?= $this->Html->link(__('Delete'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?></li>
				<?php endif; ?>
			<?php endif; ?>
            <li><?= $this->Html->link(__('View Student'), ['controller' => 'Students', 'action' => 'view', $student->id]) ?></li>
            <li><?= $this->Html->link(__('List waiting Students'), ['controller' => 'Students', 'action' => 'index', 'waiting']) ?></li>
            <li><?= $this->Html->link(__('List active Students'), ['controller' => 'Students', 'action' => 'index', 'active']) ?></li>
            <li><?= $this->Html->link(__('List inactive Students'), ['controller' => 'Students', 'action' => 'index', 'inactive']) ?></li>
        <?php endif; ?>
    </ul>
</div>
<div class="students form large-10 medium-9 columns">
    <?= $this->Form->create($student); ?>
    <fieldset>
        <legend><?= __('Edit Student') ?></legend>
        <?php
            echo $this->Form->input('first_name', ['label' => __('first_name')]);
            echo $this->Form->input('last_name', ['label' => __('last_name')]);
            echo $this->Form->label(__('sex'));
            echo $this->Form->select('sex', ['m' => __('male'), 'f' => __('female')]);
            echo $this->Form->input('street', ['label' => __('street'), 'onchange'=>'save_street(this.value)']);
            echo $this->Form->input('house_number', ['label' => __('house_number')]);
            echo $this->Form->input('house_number_addition', ['label' => __('house_number_addition')]);
            echo $this->Form->input('postcode', ['label' => __('postcode'), 'onchange'=>'save_postcode(this.value)']);
            echo $this->Form->input('city', ['label' => __('city'), 'onchange'=>'save_city(this.value)']);
            echo $this->Form->input('telephone', ['label' => __('telephone')]);
            echo $this->Form->input('mobile', ['label' => __('mobile')]);
            echo $this->Form->input('schooltype_id', ['label' => __('schooltype'), 'options' => $schooltypes, 'value' => $default_schooltype->id]);
            echo $this->Form->input('classranges', ['label' => __('classrange'), 'options' => $classranges, 'value' => $default_classrange->classrange_id]);
            echo $this->Form->input('subject1', ['label' => __('subject1'), 'options' => $subjects, 'value' => $default_subject[1]->id]);
            echo $this->Form->input('subject2', ['label' => __('subject2'), 'options' => $subjects, 'value' => $default_subject[2]->id]);
            echo $this->Form->input('subject3', ['label' => __('subject3'), 'options' => $subjects, 'value' => $default_subject[3]->id]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->button(__('Cancel'), ['type' => 'cancel', 'onclick' => 'window.history.go(-1)']) ?>
    <?= $this->Form->end() ?>
</div>
