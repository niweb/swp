<h1>Bestätigungsmail erneut senden</h1>
<?= $this->Form->create() ?>
<?= $this->Form->input('email', ['label' => 'E-Mail']) ?>
<?= $this->Form->button('Erneut Senden') ?>
<?= $this->Form->end() ?>
Noch kein Mitglied? Gleich <?= $this->Html->link(__('registrieren'), ['controller' => 'Partners', 'action' => 'register']) ?>!<br>