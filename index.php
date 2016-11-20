<html>

<head>
<meta charset="utf-8" />
<link href="style.css" rel="stylesheet"/>
</head>

<body>

<form>
<input autofocus type="text" name="search"></input>
<br />

<?php
if(isset($_GET['search'])){
  $content = $_GET['search'];
  $data = json_decode(file_get_contents('http://api.giphy.com/v1/gifs/search?q='.$content.'&limit=1&api_key=dc6zaTOxFJmzC'));
  //var_dump($data);
  $gif=$data->data[0];
  echo('<img src="'.$gif->images->original->url.'" /><br />');
  for ($i=0; $i < 5 ; $i++) {
    $content = explode('-',$gif->slug)[0];
    echo($content.'<br/>');
    $data = json_decode(file_get_contents('http://api.giphy.com/v1/gifs/search?q='.$content.'&limit=1&api_key=dc6zaTOxFJmzC'));
    $gif=$data->data[0];
    echo('<img src="'.$gif->images->original->url.'" /><br />');
  }
}


//foreach($data2->data2 as $gif){
//    echo($gif->slug.'<br/>');
//    echo('<img src="'.$gif->images->original->url.'" /><br />');
//}



//$insert = new insert();
//$insert->name=$content;
//array_push($names,$insert);
//file_put_contents('data.json', json_encode($names,TRUE));

//foreach ($names as $name){
//echo($name->name.'<br/>');
//    }

  class insert {
      public function __construct(array $arguments = array()) {
          if (!empty($arguments)) {
              foreach ($arguments as $property => $argument) {
                  $this->{$property} = $argument;
              }
          }
      }
      public function __call($method, $arguments) {
          $arguments = array_merge(array("stdObject" => $this), $arguments);
          if (isset($this->{$method}) && is_callable($this->{$method})) {
              return call_user_func_array($this->{$method}, $arguments);
          } else {
              throw new Exception("Fatal error: Call to undefined method match::{$method}()");
          }
      }
  }

?>
</form>

</body>

</html>
