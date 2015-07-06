<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <li><?= $this->Html->link(__('Edit Status Text'), ['action' => 'edit', $statusText->id]) ?> </li>
        <li><?= $this->Html->link(__('List Status Texts'), ['action' => 'index']) ?> </li>
    </ul>
</div>
<div class="statusTexts view large-10 medium-9 columns">
    <h2>Status</h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Text') ?></h6>
            <p><?= h($statusText->text) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Status Id') ?></h6>
            <p><?= $this->Number->format($statusText->status_id) ?></p>
        </div>
    </div>
</div>
