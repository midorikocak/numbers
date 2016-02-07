<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Number'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="numbers index large-9 medium-8 columns content">
    <h3><?= __('Numbers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('number') ?></th>
                <th><?= $this->Paginator->sort('who') ?></th>
                <th><?= $this->Paginator->sort('comment') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('photo') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($numbers as $number): ?>
            <tr>
                <td><?= $this->Number->format($number->id) ?></td>
                <td><?= h($number->status) ?></td>
                <td><?= h($number->number) ?></td>
                <td><?= h($number->who) ?></td>
                <td><?= h($number->comment) ?></td>
                <td><?= $number->has('user') ? $this->Html->link($number->user->id, ['controller' => 'Users', 'action' => 'view', $number->user->id]) : '' ?></td>
                <td><?= h($number->photo) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $number->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $number->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $number->id], ['confirm' => __('Are you sure you want to delete # {0}?', $number->id)]) ?>
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
