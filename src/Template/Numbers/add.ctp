<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Numbers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="numbers form large-9 medium-8 columns content">
    <?= $this->Form->create($number, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Add Number') ?></legend>
        <?php
            $options = ['-1' => 'Negative', '0' => 'Neutral', '1'=>'Positive'];
            echo $this->Form->select('status', $options);
            echo $this->Form->input('number');
            echo $this->Form->input('who');
            echo $this->Form->input('comment');
            echo $this->Form->input('photo', ['type'=>'file', 'label'=>'Photo (Optional)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
