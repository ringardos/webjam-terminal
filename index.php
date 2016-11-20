<html>

<head>
        <meta charset="utf-8" />
        <title>TERMINAL 6</title>
<link href="style.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
  WebFont.load({
    google: {
      families: ['Archivo Black']
    }
  });
</script>
</head>

<body>
<form>
 <?php echo('<input type="text" name="search" value="'.$_GET['search'].'"/>'); ?>
<br />

<?php
if(isset($_GET['search'])){
  $content = $_GET['search'];
  $data = json_decode(file_get_contents('http://api.giphy.com/v1/gifs/search?q='.$content.'&limit=3&api_key=dc6zaTOxFJmzC')); 
  //var_dump($data);
  if(count(explode('-',$data->data[0]->slug))>2){$gif=$data->data[0];}
  else if(count(explode('-',$data->data[1]->slug))>2){$gif=$data->data[1];}
  else $gif=$data->data[2];
  echo('<img src="'.$gif->images->original->url.'" /><br />');
  for ($i=0; $i < 5 ; $i++) {
    if($content!=explode('-',$gif->slug)[0]){$content=explode('-',$gif->slug)[0];}
    else $content=explode('-',$gif->slug)[1];
    $data = json_decode(file_get_contents('http://api.giphy.com/v1/gifs/search?q='.$content.'&limit=3&api_key=dc6zaTOxFJmzC')); 
    
      if(count(explode('-',$data->data[0]->slug))>2){$gif=$data->data[0];}
      else if(count(explode('-',$data->data[1]->slug))>2){$gif=$data->data[1];}
      else $gif=$data->data[2];
      echo('<img src="'.$gif->images->original->url.'" />');
      echo('<p class="text">'.$content.'</p>');  
  }
  
}

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
