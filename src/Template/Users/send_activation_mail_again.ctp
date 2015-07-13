<?php $this->assign('title', 'Bestätigungsmail erneut senden'); ?>
<br>
<h3>Bestätigungsmail erneut senden</h3>
<?= $this->Form->create() ?>
<?= $this->Form->input('email', ['label' => 'E-Mail']) ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->button(__('Cancel'), ['type' => 'cancel', 'onclick' => 'window.history.go(-1)']) ?>
<?= $this->Form->end() ?>
Noch kein Mitglied? Gleich <?= $this->Html->link(__('registrieren'), ['controller' => 'Partners', 'action' => 'register']) ?>!<br>