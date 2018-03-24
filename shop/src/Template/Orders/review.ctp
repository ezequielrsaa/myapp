<?php
$title_for_layout = 'Order Review';
$description = 'Order Review';
$keywords = 'Order, Review';
$this->set(compact('title_for_layout', 'description', 'keywords'));
?>

<?php echo $this->Html->script(['jquery.validate.js', 'additional-methods.js', 'order_review.js'], ['block' => 'script']); ?>

<h1>Review And Place Your Order</h1>

<hr>

<div class="row">
    <div class="col col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Customer Info
            </div>
            <div class="panel-body">
                <?php echo $shop['Order']['first_name'];?> <?php echo $shop['Order']['last_name'];?><br />
                Email: <?php echo $shop['Order']['email'];?><br />
                Phone: <?php echo $shop['Order']['phone'];?>
                <br />
                <br />
            </div>
        </div>
    </div>
    <div class="col col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Billing Address
            </div>
            <div class="panel-body">
                <?php echo $shop['Order']['first_name'];?> <?php echo $shop['Order']['last_name'];?><br />
                <?php echo $shop['Order']['billing_address'];?><br />
                <?php echo $shop['Order']['billing_address2'];?><br />
                <?php echo $shop['Order']['billing_city'];?>,  <?php echo $shop['Order']['billing_state'];?> <?php echo $shop['Order']['billing_zip'];?><br />

            </div>
        </div>
    </div>
    <div class="col col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Shipping Address
            </div>
            <div class="panel-body">
                <?php echo $shop['Order']['first_name'];?> <?php echo $shop['Order']['last_name'];?><br />
                <?php echo $shop['Order']['shipping_address'];?><br />
                <?php echo $shop['Order']['shipping_address2'];?><br />
                <?php echo $shop['Order']['shipping_city'];?>,  <?php echo $shop['Order']['shipping_state'];?> <?php echo $shop['Order']['shipping_zip'];?><br />
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row small">
    <div class="col col-sm-1">#</div>
    <div class="col col-sm-8">ITEM</div>
    <div class="col col-sm-1">PRICE</div>
    <div class="col col-sm-1" style="text-align: right;">QUANTITY</div>
    <div class="col col-sm-1" style="text-align: right;">SUBTOTAL</div>
</div>

<br />
<br />

<?php foreach ($shop['Orderproducts'] as $item): ?>
<div class="row">
    <div class="col col-sm-1"><?php echo $this->Html->image('/images/small/' . $item['image'], ['height' => 60, 'class' => 'img-fluid']); ?></div>
    <div class="col col-sm-8">
    <?php echo $item['name']; ?>
    <?php if(isset($item['productoption_name'])) : ?>
    <br />
    <small><?php echo $item['productoption_name']; ?></small>
    <?php endif; ?>
    </div>
    <div class="col col-sm-1">$<?php echo $item['price']; ?></div>
    <div class="col col-sm-1" style="text-align: right;"><?php echo $item['quantity']; ?></div>
    <div class="col col-sm-1" style="text-align: right;">$<?php echo $item['subtotal']; ?></div>
</div>
<?php endforeach; ?>

<hr>

<div class="row">
    <div class="col col-sm-12 tr">
        <strong>Order Summary:</strong><br />
        Subtotal: $<?php echo $shop['Order']['subtotal']; ?><br />
        Sales Tax: $<?php echo $shop['Order']['tax']; ?><br />
        <br />
        <big><strong>Order Total: <span class="textred">$<?php echo $shop['Order']['total']; ?></span></strong></big><br />
    </div>
</div>

<hr>

<br />

<?php echo $this->Form->create($order, ['id' => 'OrderReviewForm']); ?>

<div class="row">
    <div class="col col-sm-4">
        <?php echo $this->Form->input('comment', ['label' => 'Add comments about your order', 'rows' => 3, 'class' => 'form-control ccinput']); ?>
    </div>
</div>

<br />
<br />

<strong><i class="fa fa-truck"></i> SHIPPING METHOD</strong>
<br />
<br />

<?php echo $this->Form->radio('shipping_method', [['value' => 'quote', 'text' => false, 'checked']], ['hiddenField' => false]); ?> We will contact you within 24 hour window with a shipping quote excluding weekends.
<br />
<small>Your credit card will not be charged until your approval on final shipping charge.</small>
<br />
<br />
<?php echo $this->Form->radio('shipping_method', [['value' => 'pickup', 'text' => false]], ['hiddenField' => false]); ?> Pickup your order at our warehouse
<br />
<small>Los Angeles, CA 91367</small>
<br />
<br />
<br />

<strong><i class="fa fa-money"></i> PAYMENT METHOD</strong>

<br />
<br />

<div class="row">
    <div class="col col-sm-4">
        <?php echo $this->Form->input('payment_method', [
            'label' => false,
            'class' => 'form-control ccinput',
            'options' => [
            'credit_card' => 'Credit Card',
            'cod' => 'Cash on Delivery',
            ]
        ]); ?>
    </div>
</div>

<div id="paymentblock">

<br />
<br />

<div class="row">
    <div class="col col-sm-4">

        <strong>Credit or debit card</strong>
        <br />
        <?php echo $this->Form->input('creditcard_number', ['label' => false, 'class' => 'form-control ccinput', 'required' => false, 'type' => 'tel', 'maxLength' => 16, 'autocomplete' => 'off']); ?>
        <br />
    </div>
    <div class="col col-sm-2">

        <strong>Card Security Code</strong>
        <a tabindex="9999" id="cscpop" role="button" data-placement="right" data-toggle="popover" data-trigger="focus" title="Card Security Code (CSC)" data-content="<small><strong>Visa, MasterCard, Discover</strong><br /><img src=/img/visa.png><br / >The security code is the last three digits of the number that appears on the back of your card in the signature bar. <br /><br /><strong>American Express</strong><br /><img src=/img/amex.png><br />The security code is the four digits located on the front of the card, on the right side.</small>"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a>
        <br />
        <?php echo $this->Form->input('creditcard_code', ['label' => false, 'required' => false, 'class' => 'form-control', 'type' => 'tel', 'maxLength' => 4]); ?>
        <br />
    </div>
</div>

<div class="row">
    <div class="col col-sm-3 col-6">
        <?php echo $this->Form->input('creditcard_month', [
            'label' => 'Expiration Month',
            'class' => 'form-control',
            'empty' => '-',
            'options' => [
                '01' => '01 - January',
                '02' => '02 - February',
                '03' => '03 - March',
                '04' => '04 - April',
                '05' => '05 - May',
                '06' => '06 - June',
                '07' => '07 - July',
                '08' => '08 - August',
                '09' => '09 - September',
                '10' => '10 - October',
                '11' => '11 - November',
                '12' => '12 - December'
            ]
        ]); ?>
    </div>
    <div class="col col-sm-3 col-6">
        <?php echo $this->Form->input('creditcard_year', [
            'label' => 'Expiration Year',
            'class' => 'form-control',
            'empty' => '-',
            'options' => array_combine(range(date('y'), date('y') + 10), range(date('Y'), date('Y') + 10))
        ]);?>
    </div>
</div>

</div>

<br />
<br />

<?php echo $this->Form->button('<i class="fa fa-check"></i> &nbsp; Place your order', ['class' => 'btn btn-success', 'ecape' => false]); ?>

<?php echo $this->Form->end(); ?>

<br />
<br />
