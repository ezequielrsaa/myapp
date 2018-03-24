<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order'), ['action' => 'edit', $order->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orderproducts'), ['controller' => 'Orderproducts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Orderproduct'), ['controller' => 'Orderproducts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orders view large-9 medium-8 columns content">
    <h3><?= h($order->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('First Name') ?></th>
            <td><?= h($order->first_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Name') ?></th>
            <td><?= h($order->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($order->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Phone') ?></th>
            <td><?= h($order->phone) ?></td>
        </tr>
        <tr>
            <th><?= __('Billing Address') ?></th>
            <td><?= h($order->billing_address) ?></td>
        </tr>
        <tr>
            <th><?= __('Billing Address2') ?></th>
            <td><?= h($order->billing_address2) ?></td>
        </tr>
        <tr>
            <th><?= __('Billing City') ?></th>
            <td><?= h($order->billing_city) ?></td>
        </tr>
        <tr>
            <th><?= __('Billing Zip') ?></th>
            <td><?= h($order->billing_zip) ?></td>
        </tr>
        <tr>
            <th><?= __('Billing State') ?></th>
            <td><?= h($order->billing_state) ?></td>
        </tr>
        <tr>
            <th><?= __('Billing Country') ?></th>
            <td><?= h($order->billing_country) ?></td>
        </tr>
        <tr>
            <th><?= __('Shipping Address') ?></th>
            <td><?= h($order->shipping_address) ?></td>
        </tr>
        <tr>
            <th><?= __('Shipping Address2') ?></th>
            <td><?= h($order->shipping_address2) ?></td>
        </tr>
        <tr>
            <th><?= __('Shipping City') ?></th>
            <td><?= h($order->shipping_city) ?></td>
        </tr>
        <tr>
            <th><?= __('Shipping Zip') ?></th>
            <td><?= h($order->shipping_zip) ?></td>
        </tr>
        <tr>
            <th><?= __('Shipping State') ?></th>
            <td><?= h($order->shipping_state) ?></td>
        </tr>
        <tr>
            <th><?= __('Shipping Country') ?></th>
            <td><?= h($order->shipping_country) ?></td>
        </tr>
        <tr>
            <th><?= __('Order Type') ?></th>
            <td><?= h($order->order_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Authorization') ?></th>
            <td><?= h($order->authorization) ?></td>
        </tr>
        <tr>
            <th><?= __('Transaction') ?></th>
            <td><?= h($order->transaction) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= h($order->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Ip Address') ?></th>
            <td><?= h($order->ip_address) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($order->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Weight') ?></th>
            <td><?= $this->Number->format($order->weight) ?></td>
        </tr>
        <tr>
            <th><?= __('Order Item Count') ?></th>
            <td><?= $this->Number->format($order->order_item_count) ?></td>
        </tr>
        <tr>
            <th><?= __('Subtotal') ?></th>
            <td><?= $this->Number->format($order->subtotal) ?></td>
        </tr>
        <tr>
            <th><?= __('Tax') ?></th>
            <td><?= $this->Number->format($order->tax) ?></td>
        </tr>
        <tr>
            <th><?= __('Shipping') ?></th>
            <td><?= $this->Number->format($order->shipping) ?></td>
        </tr>
        <tr>
            <th><?= __('Total') ?></th>
            <td><?= $this->Number->format($order->total) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($order->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($order->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Orderproducts') ?></h4>
        <?php if (!empty($order->orderproducts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Order Id') ?></th>
                <th><?= __('Product Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Quantity') ?></th>
                <th><?= __('Weight') ?></th>
                <th><?= __('Price') ?></th>
                <th><?= __('Subtotal') ?></th>
                <th><?= __('Productmod Name') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($order->orderproducts as $orderproducts): ?>
            <tr>
                <td><?= h($orderproducts->id) ?></td>
                <td><?= h($orderproducts->order_id) ?></td>
                <td><?= h($orderproducts->product_id) ?></td>
                <td><?= h($orderproducts->name) ?></td>
                <td><?= h($orderproducts->quantity) ?></td>
                <td><?= h($orderproducts->weight) ?></td>
                <td><?= h($orderproducts->price) ?></td>
                <td><?= h($orderproducts->subtotal) ?></td>
                <td><?= h($orderproducts->productmod_name) ?></td>
                <td><?= h($orderproducts->created) ?></td>
                <td><?= h($orderproducts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Orderproducts', 'action' => 'view', $orderproducts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Orderproducts', 'action' => 'edit', $orderproducts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Orderproducts', 'action' => 'delete', $orderproducts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderproducts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
