<div class="actions columns large-2 medium-3">
    <h3><?= __('Schon registriert?') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Login'), ['action' => 'login']) ?></li>
    </ul>
</div>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __('Werde Pate') ?></legend>
        <?php
        	echo $this->Form->input('first_name', ['label' => 'Vorname']);
        	echo $this->Form->input('last_name', ['label' => 'Nachname']);
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('location_id', ['options' => $locations, 'empty' => false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
