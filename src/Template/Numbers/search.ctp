<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Add Number'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="numbers form large-9 medium-8 columns content">
    <?= $this->Form->create($number) ?>
    <fieldset>
        <legend><?= __('Search') ?></legend>
        <?php
        echo $this->Form->input('number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
