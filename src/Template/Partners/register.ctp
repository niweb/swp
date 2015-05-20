<div class="partners form large-10 medium-9 columns">
    <?= $this->Form->create($partner); ?>
    <fieldset>
        <legend><?= __('Werde Pate') ?></legend>
        <h3>Zur Person</h3>
        <?php
            echo $this->Form->input('name', ['label' => 'Vorname']);
            echo $this->Form->input('lastname', ['label' => 'Nachname']);
            echo $this->Form->input('age', ['label' => 'Alter']);
            echo $this->Form->label('sex', 'Geschlecht');
            echo $this->Form->select('sex', ['m' => 'maennlich', 'w' => 'weiblich']);
            echo $this->Form->input('degree_course', ['label' => 'Studiengang']);
            echo $this->Form->input('job', ['label' => 'Beruf']);
        ?>
        <h3>Kontaktdetails</h3>
        <?php
            echo $this->Form->input('street', ['label' => 'Strasse']);
            echo $this->Form->input('house_number', ['label' => 'Hausnummer']);
            echo $this->Form->input('house_number_addition', ['label' => 'Hausnummernzusatz']);
            echo $this->Form->input('postcode', ['label' => 'Postleitzahl']);
            echo $this->Form->input('city', ['label' => 'Stadt']);
            echo $this->Form->input('telephone', ['label' => 'Telefon']);
            echo $this->Form->input('mobile', ['label' => 'Mobil']);
        ?>
        <h3>Patenschaft</h3>
        <?php
            echo $this->Form->input('teach_time', ['label' => 'Wie viel Zeit (in Minuten) moechtest du in der Woche f�rs Unterrichten investieren? (mindestens 90)']);
            echo $this->Form->input('extra_time', ['label' => 'Wie viel Zeit (in Minuten) moechtest du im Monat zusaetzlich f�r Seminare oder Veranstaltungen gemeinsam mit deiner/m Patensch�lerIn investieren?']);
            echo $this->Form->input('spend_time', ['label' => 'Wie lange bist du in n�chster Zeit verf�gbar? (mindestens 1 Jahr']);
            echo $this->Form->textarea('experience', ['label' => 'Welche Erfahrungen hast du schon mit Nachhilfe oder Patenschaften sammeln k�nnen?']);
            echo $this->Form->input('preferred_gender', ['label' => 'Bevorzugtes Geschlecht deine/r Sch�lerIn']);
            echo $this->Form->input('support_wish', ['label' => 'Welche Unterst�tzung w�nscht du dir von uns w�hrend deiner Patenschaft?']);
            echo $this->Form->input('reason_for_decision', ['label' => 'Warum hast du dich f�r uns entschieden?']);
            echo $this->Form->input('additional_informations', ['label' => 'Gibt es sonst noch etwas, was wir �ber dich wissen sollten?']);
            echo $this->Form->input('reason_for_schuelerpaten', ['label' => 'Wie bist du auf uns gekommen?']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
