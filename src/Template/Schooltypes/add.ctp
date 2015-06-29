<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <li><?= $this->Html->link(__('List Schooltypes'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="schooltypes form large-10 medium-9 columns">
    <?= $this->Form->create($schooltype); ?>
    <fieldset>
        <legend><?= __('Add Schooltype') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('maximum_class',['label' => __('max_grade')]);
            echo $this->Form->input('minimum_class',['label' => __('min_grade')]);
            if(isset($admin)){ echo $this->Form->input('location_id', ['options' => $locations, 'empty' => false]); }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
