<h2>User</h2>

<table class="table-striped table-bordered table-condensed table-hover">
    <tr>
        <td>Id</td>
        <td><?php echo h($user->id); ?></td>
    </tr>
    <tr>
        <td>Role</td>
        <td><?php echo h($user->role); ?></td>
    </tr>
    <tr>
        <td>First Name</td>
        <td><?php echo h($user->first_name); ?></td>
    </tr>
    <tr>
        <td>Last Name</td>
        <td><?php echo h($user->last_name); ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo h($user->email); ?></td>
    </tr>
    <tr>
        <td>Active</td>
        <td><?php echo $this->Html->link($this->Html->image('icon_' . $user->active . '.png'), array('controller' => 'users', 'action' => 'toggle', 'active', $user->id), array('class' => 'toggle', 'escape' => false)); ?></td>
    </tr>
    <tr>
        <td>Login Count</td>
        <td><?php echo h($user->login_count); ?></td>
    </tr>
    <tr>
        <td>Login Last</td>
        <td><?php echo h($user->login_last); ?></td>
    </tr>
    <tr>
        <td>Created</td>
        <td><?php echo h($user->created); ?></td>
    </tr>
    <tr>
        <td>Modified</td>
        <td><?php echo h($user->modified); ?></td>
    </tr>
</table>

<br />
<br />

<h3>Logins</h3>

<table class="table-striped table-bordered table-condensed table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>user_id</th>
            <th>ip_address</th>
            <th>remote_host</th>
            <th>http_user_agent</th>
            <th>created</th>
            <!-- <th class="actions">Actions</th> -->
        </tr>
    </thead>
    <tbody>
    <?php foreach ($logins as $login): ?>
        <tr>
            <td><?= $this->Number->format($login->id) ?></td>
            <td><?= $login->user_id ?></td>
            <td><?= h($login->ip_address) ?></td>
            <td><?= h($login->remote_host) ?></td>
            <td><?= h($login->http_user_agent) ?></td>
            <td><?= h($login->created) ?></td>
            <td class="actions">
                <?php //echo $this->Html->link(__('View'), ['action' => 'view', $login->id]) ?>
                <?php // echo $this->Html->link(__('Edit'), ['action' => 'edit', $login->id]) ?>
                <?php // echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $login->id], ['confirm' => __('Are you sure you want to delete # {0}?', $login->id)]); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<br />
<br />

<h3>Actions</h3>

<br />

<?php echo $this->Html->link('Edit User', ['action' => 'edit', $user->id], ['class' => 'btn btn-default']); ?>

<br />
<br />

<?php echo $this->Form->postLink('Delete User', ['action' => 'delete', $user->id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]); ?>

<br />
<br />

