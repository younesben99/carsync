<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>title</title>
  <link rel="stylesheet" href="stylesheet.css" type="text/css">
  </head>
  <body>
 <style>.cardwrap .card{margin:10px 10px;}.cardwrap{display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;}</style>
<div class="container">
 
    <h1>Dashboard</h1>
    <div class="cardwrap">
  <?php 

$allposts= get_posts( array('post_type'=>'autos','numberposts'=>-1) );
foreach ($allposts as $post) {
  display_admin_card($post);
}

?>
</div></div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.5.3/modernizr.min.js" type="text/javascript"></script>
  </body>
</html> -->