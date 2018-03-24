<strong>Thank you for your order!</strong>

<br />
<br />

<table width="100%">
<tr>
    <td valign="top">
        <strong>Customer Info</strong>
        <br />
        <?php echo $shop['Order']['first_name'];?> <?php echo $shop['Order']['last_name'];?><br />
        Email: <?php echo $shop['Order']['email'];?><br />
        Phone: <?php echo $shop['Order']['phone'];?>
    </td>
    <td valign="top">
        <strong>Billing Address</strong>
        <br />
        <?php echo $shop['Order']['first_name'];?> <?php echo $shop['Order']['last_name'];?><br />
        <?php echo $shop['Order']['billing_address'];?><br />
        <?php echo $shop['Order']['billing_address2'];?><br />
        <?php echo $shop['Order']['billing_city'];?>,  <?php echo $shop['Order']['billing_state'];?> <?php echo $shop['Order']['billing_zip'];?>
    </td>
    <td valign="top">
        <strong>Shipping Address</strong>
        <br />
        <?php echo $shop['Order']['first_name'];?> <?php echo $shop['Order']['last_name'];?><br />
        <?php echo $shop['Order']['shipping_address'];?><br />
        <?php echo $shop['Order']['shipping_address2'];?><br />
        <?php echo $shop['Order']['shipping_city'];?>,  <?php echo $shop['Order']['shipping_state'];?> <?php echo $shop['Order']['shipping_zip'];?><br />
    </td>
</tr>
</table>

<br />
<br />

<strong>Products</strong>

<br />

<table width="100%">
    <tr>
        <td>#</td>
        <td>Product Name</td>
        <td>Price</td>
        <td>Quantity</td>
        <td>Subtotal</td>
    </tr>
<?php foreach ($shop['Orderproducts'] as $item): ?>
    <tr>
        <td><?php // echo $this->Html->image('https://www.domain.com/images/products/' . $item['image'], ['height' => 60, 'class' => 'px60']); ?></td>
        <td><?php echo $item['name']; ?>
            <?php if(isset($item['productoption_name'])) : ?>
            <br />
            <small><?php echo $item['productoption_name']; ?></small>
            <?php endif; ?>
        </td>
        <td>$<?php echo $item['price']; ?></td>
        <td><?php echo $item['quantity']; ?></td>
        <td>$<?php echo $item['subtotal']; ?></td>
    </tr>
<?php endforeach; ?>
</table>

<br />
<br />

<strong>Order Summary:</strong>
<br />
Subtotal: $<?php echo $shop['Order']['subtotal']; ?><br />
Sales Tax: $<?php echo $shop['Order']['tax']; ?><br />
Order Total: $<?php echo $shop['Order']['total']; ?><br />

<br />

<strong>Shipping Method:</strong>
<br />
<?php echo $order->shipping_method; ?><br />

<br />

<strong>Payment Method:</strong>
<br />
<?php echo $order->payment_method; ?><br />

<br />

<small>Order placed from IP Address: <?php echo $order->ip_address; ?></small>

<br />
<br />

We will be in touch with you as soon as possible.

<br />
<br />

<br />
<br />
<br />
<br />
