<div class="actions columns large-5 medium-3">
    <h3><?= __('Match Partner') ?></h3>
    <h6 class="subheader"><?= __('Status')?></h6>
    <p><?= $partner->has('status') ? h($partner->status->name) : 'Kein Status'?></p>
    <h6 class="subheader"><?= __('first_name') ?></h6>
    <p><?= h($partner->user->first_name) ?></p>
    <h6 class="subheader"><?= __('last_name') ?></h6>
    <p><?= h($partner->user->last_name) ?></p>
    <h6 class="subheader"><?= __('sex') ?></h6>
    <p><?= h($partner->sex) ?></p>
    <h6 class="subheader"><?= __('age') ?></h6>
    <p><?= $this->Number->format($partner->age) ?></p>
    <h6 class="subheader"><?= __('degree_course') ?></h6>
    <p><?= h($partner->degree_course) ?></p>
    <h6 class="subheader"><?= __('job') ?></h6>
    <p><?= h($partner->job) ?></p>
    <h6 class="subheader"><?= __('teach_time') ?></h6>
    <p><?= $this->Number->format($partner->teach_time) ?></p>
    <h6 class="subheader"><?= __('extra_time') ?></h6>
    <p><?= $this->Number->format($partner->extra_time) ?></p>
    <h6 class="subheader"><?= __('spend_time') ?></h6>
    <p><?= h($partner->spend_time) ?></p>
    <h6 class="subheader"><?= __('experience') ?></h6>
    <p><?= h($partner->experience) ?></p>
    <h6 class="subheader"><?= __('preferred_gender') ?></h6>
    <p><?= h($partner->preferred_gender) ?></p>
    <h6 class="subheader"><?= __('support_wish') ?></h6>
    <p><?= h($partner->support_wish) ?></p>
    <h6 class="subheader"><?= __('reason_for_decision') ?></h6>
    <p><?= h($partner->reason_for_decision) ?></p>
    <h6 class="subheader"><?= __('additional_information') ?></h6>
    <p><?= h($partner->additional_informations) ?></p>
    <h6 class="subheader"><?= __('reason_for_schuelerpaten') ?></h6>
    <p><?= h($partner->reason_for_schuelerpaten) ?></p>
    <h6 class="subheader"><?= __('street') ?></h6>
    <p><?= h($partner->street) ?></p>
    <h6 class="subheader"><?= __('house_number') ?></h6>
    <p><?= h($partner->house_number) ?></p>
    <h6 class="subheader"><?= __('house_number_addition') ?></h6>
    <p><?= h($partner->house_number_addition) ?></p>
    <h6 class="subheader"><?= __('postcode') ?></h6>
    <p><?= h($partner->postcode) ?></p>
    <h6 class="subheader"><?= __('city') ?></h6>
    <p><?= h($partner->city) ?></p>
</div>
<div class="partners index large-7 medium-6 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('first_name') ?></th>
            <th><?= $this->Paginator->sort('last_name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $this->Number->format($student->id) ?></td>
            <td><?= h($student->first_name) ?></td>
            <td><?= h($student->last_name) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Match'), ['action' => 'match', $partner->id, $student->id], ['confirm' => __('Are you sure you want to match {0} with {1}?', $student->first_name, $partner->user->first_name)])?>
                <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $student->id]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
