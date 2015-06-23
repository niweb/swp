<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <?php if(isset($matchmaker)) : ?>
            <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <?php endif; ?>
    </ul>
</div>
<div class="students form large-10 medium-9 columns">
    <?= $this->Form->create($student); ?>
    <fieldset>
        <legend><?= __('Add Student') ?></legend>
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
            echo $this->Form->input('mobile', ['label' => __('mobile'), 'id'=>'mobile']);
			echo $this->Form->input('classranges', ['label' => __('classranges'), 'options' => $classranges]);
			echo $this->Form->input('subject1', ['label' => __('subject1'), 'options' => $subjects]);
			echo $this->Form->input('subject2', ['label' => __('subject2'), 'options' => $subjects]);
			echo $this->Form->input('subject3', ['label' => __('subject3'), 'options' => $subjects]);
            ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>