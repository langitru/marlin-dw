<?php 

  $this->layout('layout', ['title' => 'All Posts', 'username' => $username]);
  // $this->layout('layout', ['vars' => ['title' => 'All Posts', 'username1' => $username]]);

 ?>

    
    <h1>Index</h1>
    <?= flash()->display();?>

