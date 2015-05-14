<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $partner->partner_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $partner->partner_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Partners'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="partners form large-10 medium-9 columns">
    <?= $this->Form->create($partner); ?>
    <fieldset>
        <legend><?= __('Edit Partner') ?></legend>
        <?php
            echo $this->Form->input('id');
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
            echo $this->Form->input('preffered_gender');
            echo $this->Form->input('support_wish');
            echo $this->Form->input('reason_for_decision');
            echo $this->Form->input('additional_informations');
            echo $this->Form->input('reason_for_schuelerpaten');
            echo $this->Form->input('location_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
