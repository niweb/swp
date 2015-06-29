<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <?php if(isset($matchmaker)) : ?>
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
        <legend><?= __('Add Partner') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('lastname');
            echo $this->Form->input('age');
            echo $this->Form->input('sex');
            echo $this->Form->input('degree_course');
            echo $this->Form->input('job');
            echo $this->Form->input('street');
            echo $this->Form->input('house_number');
            echo $this->Form->input('house_number_addition');
            echo $this->Form->input('postcode');
            echo $this->Form->input('city');
            echo $this->Form->input('telephone');
            echo $this->Form->input('mobile');
            echo $this->Form->input('teach_time');
            echo $this->Form->input('extra_time');
            echo $this->Form->input('spend_time');
            echo $this->Form->input('experience');
			echo $this->Form->label('preferred_gender');
            echo $this->Form->select('preferred_gender', ['' => __('whatever'), 'm' => __('male'), 'f' => __('female')]);
            echo $this->Form->input('support_wish');
            echo $this->Form->input('reason_for_decision');
            echo $this->Form->input('additional_informations');
            echo $this->Form->input('reason_for_schuelerpaten');
            echo $this->Form->input('location_id', ['options' => $locations, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
