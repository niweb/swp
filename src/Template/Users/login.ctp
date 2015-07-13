<?php $this->assign('title', 'Login'); ?>
<br>
<h1>Login</h1>
<?= $this->Form->create() ?>
<?= $this->Form->input('email', ['label' => __('email')]) ?>
<?= $this->Form->input('password', ['label' => __('password')]) ?>
<?= $this->Form->button(__('Login')) ?>
<?= $this->Form->end() ?>
Noch kein Mitglied? Gleich <?= $this->Html->link(__('registrieren'), ['controller' => 'Partners', 'action' => 'register', 1]) ?>!<br>
Aktivierungsmail nicht erhalten? Hier <?= $this->Html->link(__('erneut anfordern'), ['controller' => 'Users', 'action' => 'sendActivationMailAgain']) ?>!<br>
Passwort vergessen? Hier <?= $this->Html->link(__('zurücksetzen'), ['controller' => 'Users', 'action' => 'reset']) ?>!<br>