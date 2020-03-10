<?php 

  $this->layout('layout', ['title' => 'All Users', 'username' => $username]);
  // $this->layout('layout', ['vars' => ['title' => 'All Posts', 'username1' => $username]]);

 ?>

    
    <h1>All users</h1>
    <?= flash()->display();?>

    <table class="table">
      <a href="/usercreate" class="btn btn-success">Add user</a>
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Имя пользователя</th>
          <th scope="col">Статус</th>
          <th scope="col">Действия</th>
        </tr>
      </thead>
      <tbody>
        
        <?php foreach($users as $user):?>
        <tr>
          <th scope="row"><?= $user['id'];?></th>
          <td><a href="/usershow/<?= $user['id'];?>"><?= $user['username'];?></a></td>
          <td><?= $user['verified'] ? 'verified' : 'not verified';?></td>
          <td>
            <a href="/useredit/<?= $user['id'];?>" class="btn btn-warning">Edit</a>
            <a href="/userdelete/<?= $user['id'];?>" 
              class="btn btn-danger" 
              onclick="return confirm('Вы действительно ходите удалить пользователя?')">Delete
            </a>
          </td>
        </tr>
        <?php endforeach;?>

      </tbody>
    </table>



