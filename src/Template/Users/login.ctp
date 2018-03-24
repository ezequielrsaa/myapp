<h1>Log In</h1>

<br />

<div class="row">
    <div class="col-sm-5">

        <?php echo $this->Form->create('User', ['url' => ['action' => 'login']]); ?>
        <?php echo $this->Form->input('email', ['class' => 'form-control', 'autofocus' => 'autofocus']); ?>
        <br />
        <?php echo $this->Form->input('password', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->button('LOG IN', ['class' => 'btn btn-secondary']); ?>
        <?php echo $this->Form->end(); ?>
        <br />

    </div>
</div>

<br />
