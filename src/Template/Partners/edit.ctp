<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <?php if(isset($vermittler) or isset($locationAdmin) or isset($admin)) : ?>
			<?php if($partner->status_id < 7) : ?>
				<li><?= $this->Form->postLink(__('Deactivate'), ['action' => 'deactivate', $partner->id], ['confirm' => __('Are you sure you want to deactivate {0}?', h($partner->user->first_name.' '.$partner->user->last_name))]) ?></li>
			<?php else : ?>
				<li><?= $this->Form->postLink(__('Reactivate'), ['action' => 'reactivate', $partner->id], ['confirm' => __('Are you sure you want to reactivate {0}?', h($partner->user->first_name.' '.$partner->user->last_name))]) ?></li>
				<?php if(isset($locationAdmin)) : ?>
					<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partner->id], ['confirm' => __('Are you sure you want to delete {0}?', h($partner->user->first_name.' '.$partner->user->last_name))]) ?></li>
				<?php endif; ?>
			<?php endif; ?>
            <li><?= $this->Html->link(__('View Partner'), ['controller' => 'Partners', 'action' => 'view', $partner->id]) ?></li>
            <li><?= $this->Html->link(__('List verified Partners'), ['controller' => 'Partners', 'action' => 'index', 'verified']) ?></li>
            <li><?= $this->Html->link(__('List waiting and matched Partners'), ['controller' => 'Partners', 'action' => 'index', 'active']) ?></li>
            <li><?= $this->Html->link(__('List quit and denied Partners'), ['controller' => 'Partners', 'action' => 'index', 'inactive']) ?></li>
        <?php else: ?>
            <li><?= $this->Html->link(__('View Partner'), ['controller' => 'Partners', 'action' => 'view', $partner->id]) ?></li>
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
            echo $this->Form->input('age', ['value' => $partner->age, 'label' => __('age')]);
            echo $this->Form->label(__('sex'));
            echo $this->Form->select('sex', ['m' => __('male'), 'f' => __('female')]);
            echo $this->Form->input('degree_course', ['value' => $partner->degree_course, 'label' => __('degree_course')]);
            echo $this->Form->input('job', ['value' => $partner->job, 'label' => __('job')]);
            echo $this->Form->input('street', ['value' => $partner->street, 'label' => __('street')]);
            echo $this->Form->input('house_number', ['value' => $partner->house_number, 'label' => __('house_number')]);
            echo $this->Form->input('house_number_addition', ['value' => $partner->house_number_addition, 'label' => __('house_number_addition')]);
            echo $this->Form->input('postcode', ['value' => $partner->postcode, 'label' => __('postcode')]);
            echo $this->Form->input('city', ['value' => $partner->city, 'label' => __('city')]);
            echo $this->Form->input('telephone', ['value' => $partner->telephone, 'label' => __('telephone')]);
            echo $this->Form->input('mobile', ['value' => $partner->mobile, 'label' => __('mobile')]);
			echo $this->Form->label(__('preferred_classranges'));
			echo '<table border=0><tr>';
			foreach($classranges as $classrange){
				$checked = false;
                echo '<td>';
				foreach($partner->preferred_classranges as $pclass){
					if($pclass->classrange_id == $classrange->id){
						$checked = true;
					}
				}
				if($checked){
					echo $this->Form->input("preferredClassranges.{$classrange['id']}", ['type' => 'checkbox', 'label' => $classrange['name'], 'checked' => 'checked']);
				} else {
					echo $this->Form->input("preferredClassranges.{$classrange['id']}", ['type' => 'checkbox', 'label' => $classrange['name']]);
				}
                
                echo '</td>';
            }
			echo '</tr></table>';
			echo $this->Form->label(__('preferred_schooltypes'));
			echo '<table border=0><tr>';
			foreach($schooltypes as $schooltype){
				$checked = false;
                echo '<td>';
				foreach($partner->preferred_schooltypes as $pschool){
					if($pschool->schooltype_id == $schooltype->id){
						$checked = true;
					}
				}
				if($checked){
					echo $this->Form->input("preferredSchooltypes.{$schooltype['id']}", ['type' => 'checkbox', 'label' => $schooltype['name'], 'checked' => 'checked']);
				} else {
					echo $this->Form->input("preferredSchooltypes.{$schooltype['id']}", ['type' => 'checkbox', 'label' => $schooltype['name']]);
				}
                
                echo '</td>';
            }
			echo '</tr></table>';
			echo $this->Form->label(__('preferred_subjects'));
            echo '<em>'. __("preferred_subjects_addition") .'</em>';
            echo '<table border=0><tr><th>'.__('subject').'</th><th>'.__('max_grade').'</th></tr>';
            foreach($subjects as $subject){
				$tmpsubject = '';
                echo '<tr><td>'. $this->Form->label($subject['name']) .'</td>';
				foreach($partner->preferred_subjects as $psubject){
					if($psubject->subject_id == $subject->id){
						$tmpsubject = $psubject->maximum_class;
					}
				}
                echo '<td>'. $this->Form->input("preferredSubjects.{$subject['id']}", ['label' => false, 'value' => $tmpsubject]) .'</td></tr>';
            }
			echo '</tr></table>';
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->button(__('Cancel'), ['type' => 'cancel', 'onclick' => 'window.history.go(-1)']) ?>
    <?= $this->Form->end() ?>
</div>
