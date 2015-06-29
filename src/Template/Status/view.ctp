<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Status'), ['action' => 'edit', $status->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Status'), ['action' => 'delete', $status->id], ['confirm' => __('Are you sure you want to delete # {0}?', $status->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Status'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="status view large-10 medium-9 columns">
    <h2><?= h($status->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($status->name) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Partners') ?></h4>
    <?php if (!empty($status->partners)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Age') ?></th>
            <th><?= __('Sex') ?></th>
            <th><?= __('Degree Course') ?></th>
            <th><?= __('Job') ?></th>
            <th><?= __('Street') ?></th>
            <th><?= __('House Number') ?></th>
            <th><?= __('House Number Addition') ?></th>
            <th><?= __('Postcode') ?></th>
            <th><?= __('City') ?></th>
            <th><?= __('Telephone') ?></th>
            <th><?= __('Mobile') ?></th>
            <th><?= __('Teach Time') ?></th>
            <th><?= __('Extra Time') ?></th>
            <th><?= __('Spend Time') ?></th>
            <th><?= __('Experience') ?></th>
            <th><?= __('Preferred Gender') ?></th>
            <th><?= __('Support Wish') ?></th>
            <th><?= __('Reason For Decision') ?></th>
            <th><?= __('Additional Informations') ?></th>
            <th><?= __('Reason For Schuelerpaten') ?></th>
            <th><?= __('Location Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Status Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($status->partners as $partners): ?>
        <tr>
            <td><?= h($partners->id) ?></td>
            <td><?= h($partners->age) ?></td>
            <td><?= h($partners->sex) ?></td>
            <td><?= h($partners->degree_course) ?></td>
            <td><?= h($partners->job) ?></td>
            <td><?= h($partners->street) ?></td>
            <td><?= h($partners->house_number) ?></td>
            <td><?= h($partners->house_number_addition) ?></td>
            <td><?= h($partners->postcode) ?></td>
            <td><?= h($partners->city) ?></td>
            <td><?= h($partners->telephone) ?></td>
            <td><?= h($partners->mobile) ?></td>
            <td><?= h($partners->teach_time) ?></td>
            <td><?= h($partners->extra_time) ?></td>
            <td><?= h($partners->spend_time) ?></td>
            <td><?= h($partners->experience) ?></td>
            <td><?= h($partners->preferred_gender) ?></td>
            <td><?= h($partners->support_wish) ?></td>
            <td><?= h($partners->reason_for_decision) ?></td>
            <td><?= h($partners->additional_informations) ?></td>
            <td><?= h($partners->reason_for_schuelerpaten) ?></td>
            <td><?= h($partners->location_id) ?></td>
            <td><?= h($partners->user_id) ?></td>
            <td><?= h($partners->status_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Partners', 'action' => 'view', $partners->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Partners', 'action' => 'edit', $partners->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Partners', 'action' => 'delete', $partners->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partners->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
