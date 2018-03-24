<?php $this->set('title_for_layout', 'Address'); ?>

<?php echo $this->Html->script(['order_address.js'], ['block' => 'script']); ?>

<h1>Address</h1>

<?php echo $this->Form->create($order); ?>

<hr>

<div class="row">
    <div class="col col-sm-4">

        <?php echo $this->Form->input('first_name', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('last_name', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('email', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('phone', ['class' => 'form-control']); ?>
        <br />
        <br />

    </div>
    <div class="col col-sm-4">

        <?php echo $this->Form->input('billing_address', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('billing_address2', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('billing_city', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('billing_state', ['options' => $this->Site->states(), 'empty' => 'Please Select', 'class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('billing_zip', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('billing_country', ['class' => 'form-control']); ?>
        <br />
        <br />

        <?php echo $this->Form->input('sameaddress', ['type' => 'checkbox', 'label' => 'Copy Billing Address to Shipping']); ?>

    </div>
    <div class="col col-sm-4">

        <?php echo $this->Form->input('shipping_address', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('shipping_address2', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('shipping_city', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('shipping_state', ['options' => $this->Site->states(), 'empty' => 'Please Select', 'class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('shipping_zip', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->input('shipping_country', ['class' => 'form-control']); ?>
        <br />
        <br />

    </div>
</div>

<br />

<?php echo $this->Form->button('<i class="fa fa-check"></i> &nbsp; Continue', ['class' => 'btn btn-success btn-sm', 'escape' => false]);?>
<?php echo $this->Form->end(); ?>
