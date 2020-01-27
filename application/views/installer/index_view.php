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
  <form>
    
<div class="left ">
<div>
  <label for="database_name"></label>
  <input type="text" name="database_name" placeholder="Database Name" />

</div>

<div>
  <label for="database_password"></label>
  <input type="" name="database_password" placeholder="Database Password" />

</div>

<div>
  <label for="database_host"></label>
  <input type="text" name="database_host" placeholder="Database Host"/>

</div>
</div>
<div class="right">
<div>
  <label for="database_username"></label>
  <input type="text" name="database_username" placeholder="Database Username"/>

</div>
 <div>
  <label for="url"></label>
  <input type="text" name="url" placeholder="Site URL e.g https://world.com"/>

</div>

</div>

<input type="submit" name="submit" value="Install Now" class="button"/>
  </form>
</div>
</body>
</html>