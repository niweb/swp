<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
		<li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('first_name', ['label' => __('first_name')]);
            echo $this->Form->input('last_name', ['label' => __('last_name')]);
            echo $this->Form->input('email', ['label' => __('email')]);
            echo $this->Form->input('password', ['label' => __('password')]);
            echo $this->Form->input('type_id', ['label' => __('Type'), 'options' => $types, 'empty' => false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
