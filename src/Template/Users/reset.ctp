<h1>Passwort zurücksetzen</h1>
<?= $this->Form->create() ?>
<?= $this->Form->input('email', ['label' => 'E-Mail']) ?>
<?= $this->Form->button('Submit') ?>
<?= $this->Form->end() ?>