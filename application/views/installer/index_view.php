<!DOCTYPE html>
<html>
<head>
<title>Installation</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style type="text/css">
input {
  padding: 16px;
    margin: 16px;
    border: 1px solid lightblue;
    box-decoration-break: slice;

}
.container {
  padding: 32px;
  margin: 16px;
  align-items: center;
}
.button {
  margin: 32px;
  padding: 14px 10px;
  background-color: rgb(109,74,159);
  color: white;
  border: 0;
  border-radius: 5%;


}
.text-red {
  color: red;
}
.button:hover{
    padding: 16px 12px;

}
.word {

font-size: 1.4em;
}

@media screen and (min-width: 500px){
.right {

float: right;
width: 50%;
}
.left {

float: left;
width: 50%;
}

}

</style>
</head>
<body>
  <div class="container">

<strong class="word"><?=$appName ?>  Installation</strong>
<br>
  <form action="./index" method="POST">

    <span class="text-red"><?= validation_errors()?></span>
    
<div class="left ">
<div>
  <label for="database_name">Database Name</label>
  <input type="text" name="database_name" placeholder="Database Name" value="<?=$settings['database']?>"  />

</div>

<div>
  <label for="database_password">Password</label>
  <input type="password" name="database_password" placeholder="Database Password" value="<?=$settings['password']?>" />

</div>

<div>
  <label for="database_host">HostName</label>
  <input type="text" name="database_host" placeholder="Database Host" value="<?=$settings['hostname']?>"/>

</div>
</div>
<div class="right">
<div>
  <label for="database_username">Username</label>
  <input type="text" name="database_username" placeholder="Database Username" value="<?=$settings['username']?>"/>

</div>
 <div>
  <label for="url">Site URL</label>
  <input type="text" name="url" placeholder="Site URL e.g https://world.com" value="<?=$settings['base_url']?>"/>

</div>

</div>

<input type="submit" name="submit" value="Install Now" class="button"/>
  </form>
</div>
</body>
</html>