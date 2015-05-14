<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Partner'), ['action' => 'edit', $partner->partner_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Partner'), ['action' => 'delete', $partner->partner_id], ['confirm' => __('Are you sure you want to delete # {0}?', $partner->partner_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="partners view large-10 medium-9 columns">
    <h2><?= h($partner->partner_id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($partner->name) ?></p>
            <h6 class="subheader"><?= __('Lastname') ?></h6>
            <p><?= h($partner->lastname) ?></p>
            <h6 class="subheader"><?= __('Sex') ?></h6>
            <p><?= h($partner->sex) ?></p>
            <h6 class="subheader"><?= __('Degree Course') ?></h6>
            <p><?= h($partner->degree_course) ?></p>
            <h6 class="subheader"><?= __('Job') ?></h6>
            <p><?= h($partner->job) ?></p>
            <h6 class="subheader"><?= __('Street') ?></h6>
            <p><?= h($partner->street) ?></p>
            <h6 class="subheader"><?= __('House Number') ?></h6>
            <p><?= h($partner->house_number) ?></p>
            <h6 class="subheader"><?= __('House Number Addition') ?></h6>
            <p><?= h($partner->house_number_addition) ?></p>
            <h6 class="subheader"><?= __('Postcode') ?></h6>
            <p><?= h($partner->postcode) ?></p>
            <h6 class="subheader"><?= __('City') ?></h6>
            <p><?= h($partner->city) ?></p>
            <h6 class="subheader"><?= __('Telephone') ?></h6>
            <p><?= h($partner->telephone) ?></p>
            <h6 class="subheader"><?= __('Mobile') ?></h6>
            <p><?= h($partner->mobile) ?></p>
            <h6 class="subheader"><?= __('Spend Time') ?></h6>
            <p><?= h($partner->spend_time) ?></p>
            <h6 class="subheader"><?= __('Experience') ?></h6>
            <p><?= h($partner->experience) ?></p>
            <h6 class="subheader"><?= __('Preffered Gender') ?></h6>
            <p><?= h($partner->preffered_gender) ?></p>
            <h6 class="subheader"><?= __('Support Wish') ?></h6>
            <p><?= h($partner->support_wish) ?></p>
            <h6 class="subheader"><?= __('Reason For Decision') ?></h6>
            <p><?= h($partner->reason_for_decision) ?></p>
            <h6 class="subheader"><?= __('Additional Informations') ?></h6>
            <p><?= h($partner->additional_informations) ?></p>
            <h6 class="subheader"><?= __('Reason For Schuelerpaten') ?></h6>
            <p><?= h($partner->reason_for_schuelerpaten) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($partner->id) ?></p>
            <h6 class="subheader"><?= __('Age') ?></h6>
            <p><?= $this->Number->format($partner->age) ?></p>
            <h6 class="subheader"><?= __('Teach Time') ?></h6>
            <p><?= $this->Number->format($partner->teach_time) ?></p>
            <h6 class="subheader"><?= __('Extra Time') ?></h6>
            <p><?= $this->Number->format($partner->extra_time) ?></p>
            <h6 class="subheader"><?= __('Location Id') ?></h6>
            <p><?= $this->Number->format($partner->location_id) ?></p>
        </div>
    </div>
</div>
