<div class="partners form large-10 medium-9 columns">
    <?php if($location_name == null): ?>
    <fieldset>
        <legend><?=h(__('Become Schülerpate').' in ...')?><legend>
        <?= $this->Html->link(__('Berlin'), ['controller' => 'Partners', 'action' => 'register', 1]) ?>,
        <?= $this->Html->link(__('Frankfurt'), ['controller' => 'Partners', 'action' => 'register', 2]) ?>,
        <?= $this->Html->link(__('Ruhr'), ['controller' => 'Partners', 'action' => 'register', 3]) ?> oder
        <?= $this->Html->link(__('Braunschweig'), ['controller' => 'Partners', 'action' => 'register', 4]) ?><br>
    </fieldset>
    <?php else: ?>
    <?= $this->Form->create($partner); ?>
    <fieldset>
        <legend><?= h(__('Become Schülerpate').' in '.$location_name)?></legend>

        <h3><?= __('Login Details') ?></h3>
	 <?php
            echo $this->Form->input('user.email');
            echo $this->Form->input('user.password');
        ?>
	<h3><?= __('Personal Details') ?></h3>
        <?php
            echo $this->Form->input('user.first_name', ['label' => __('first_name')]);
            echo $this->Form->input('user.last_name', ['label' => __('last_name')]);
            echo $this->Form->input('age', ['label' => __('age')]);
            echo $this->Form->label(__('sex'));
            echo $this->Form->select('sex', ['m' => __('male'), 'f' => __('female')]);
            echo $this->Form->input('degree_course', ['label' => __('degree_course')]);
            echo $this->Form->input('job', ['label' => __('job')]);
        ?>
        <h3><?= __('Contact Details') ?></h3>
        <?php
            echo $this->Form->input('street', ['label' => __('street'), 'required' => true, 'id'=>'street', 'type'=>'text']);
            echo $this->Form->input('house_number', ['label' => __('house_number'), 'required' => true]);
            echo $this->Form->input('house_number_addition',['label' => __('house_number_addition')]);
            echo $this->Form->input('postcode', ['label' => __('postcode'), 'required' => true]);
            echo $this->Form->input('city', ['label' => __('city'),'required' => true]);
            echo $this->Form->input('telephone', ['label' => __('telephone')]);
            echo $this->Form->input('mobile',['label' => __('mobile')]);
        ?>
        <h3><?= __('Tutorship') ?></h3>
        
        <?= $this->Form->label(__('preferred_classranges')) ?>
        <table border=0><tr>
        <?php
            foreach($classranges as $classrange){
                echo '<td>';
                echo $this->Form->input("preferredClassranges.{$classrange['id']}", ['type' => 'checkbox', 'label' => $classrange['name']]);
                echo '</td>';
            }
        ?>
        </tr></table>
        
        <?= $this->Form->label(__('preferred_schooltypes')) ?>
        <table border=0><tr>
        <?php
            foreach($schooltypes as $schooltype){
                echo '<td>';
                echo $this->Form->input("preferredSchooltypes.{$schooltype['id']}", ['type' => 'checkbox', 'label' => $schooltype['name']]);
                echo '</td>';
            }
        ?>
        </tr></table>
        
        <?php
            echo $this->Form->label(__('preferred_subjects'));
            echo '<em>'. __("preferred_subjects_addition") .'</em>';
            echo '<table border=0><tr><th>'.__('subject').'</th><th>'.__('max_grade').'</th></tr>';
            foreach($subjects as $subject){
                echo '<tr><td>'. $this->Form->label($subject['name']) .'</td>';
                echo '<td>'. $this->Form->input("preferredSubjects.{$subject['id']}", ['label' => false]) .'</td></tr>';
            }
        ?>
        </table>

        <?php
            echo $this->Form->input('teach_time', ['label' => __('teach_time'), 'required' => true]);
            echo $this->Form->input('extra_time', ['label' => __('extra_time'), 'required' => true]);
            echo $this->Form->input('spend_time', ['label' => __('spend_time'), 'required' => true]);
            
            echo $this->Form->input('experience', ['label' => __('experience'), 'required' => true]);
            
            echo $this->Form->label(__('preferred_gender'));
            echo $this->Form->select('preferred_gender', ['' => __('whatever'), 'm' => __('male'), 'f' => __('female')]);
            
            echo $this->Form->label(__('support_wish'));
            echo $this->Form->textarea('support_wish');
            
            echo $this->Form->input('reason_for_decision', ['label' => __('reason_for_decision'), 'required' => true]);            
            echo $this->Form->input('additional_informations', ['label' => __('additional_informations')]);
            echo $this->Form->input('reason_for_schuelerpaten', ['label' => __('reason_for_schuelerpaten'), 'required' => true]);
    
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <?php endif; ?>
