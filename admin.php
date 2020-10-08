<?php
if(isset($_POST['submitData'])){
  $json = $_POST['submitData'];
  $file = fopen("data/data.json","w");
  echo fwrite($file,$json);
  fclose($file);
}


// Read JSON file
$json = file_get_contents('./data/data.json');
$cat = file_get_contents('./data/cat.json');

//Decode JSON
// $json_data = json_decode($json,true);

//Print data
// print_r($json_data);

//session start
session_start();
$loginPage = true;
$validation = false;

// logout
if(isset($_GET["action"])){
  if($_GET["action"]=="logout"){
    // remove all session variables
  session_unset();

  // destroy the session
  session_destroy();
  $loginPage = true;
  }
}

// session login
if(isset($_SESSION["login"])){
  if($_SESSION["login"]==true){
    $loginPage = false;
  }
  else{
    $loginPage = true;
  }
}

// login
if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['inputPassword'])){
    $inputPassword = $_POST['inputPassword'];
    if($inputPassword=="ayush"){
      $loginPage = false;
      $_SESSION["login"] = true;
    }
    else{
      $validation = true;
    }
  }
  // if(isset($_POST['submitData'])){
  //   return($_POST['submitData']);
  // }
  
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin | DEKORA HOMES</title>
  <link rel="shortcut icon" href="images/logo/logo.jpeg">
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

  <script type="text/javascript">
$(document).ready(function() {

var MaxInputs       = 2; //maximum extra input boxes allowed
var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
var AddButton       = $("#AddMoreFileBox"); //Add button ID
var SaveButton      = $("#SaveData"); //Add button ID
var AddCat          = $("#AddMoreCatBox"); //Add button ID
var InputCat        = $("#AddMoreCatId");
var SaveCat         = $("#SaveCatBox");

var x = InputsWrapper.length; //initlal text box count
var FieldCount=1; //to keep track of text box added
var CatCount=1; //to keep track of text box added

var data = <?php echo($json); ?>;
var cat = <?php echo($cat); ?>;


//show saved data

getData();
function getData(){
for (FieldCount = 1; FieldCount <= data.length; FieldCount++) {
  $(InputsWrapper).append('<div id="'+FieldCount+'"><h3><b>Product '+FieldCount+' :</b></h3><br>'+
              'Name: <input type="text" name="name" id="name_'+ FieldCount +'" value="'+data[FieldCount-1]["name"]+'"/><br>'+
              'Prize : <input type="number" name="cost" id="cost_'+ FieldCount+'" value="'+data[FieldCount-1]["prize"] +'"/><br>'+
              'Info 1: <input type="text" name="info1" id="info1_'+ FieldCount+'" value="'+data[FieldCount-1]["info1"] +'"/><br>'+
              'Info 2: <input type="text" name="info2" id="info2_'+ FieldCount+'" value="'+data[FieldCount-1]["info2"] +'"/><br>'+
              'Info 3: <input type="text" name="info3" id="info3_'+ FieldCount+'" value="'+data[FieldCount-1]["info3"] +'"/><br>'+
              'Description:<br> <textarea type="text" name="desc" id="desc_'+ FieldCount+'" rows="5" cols="40"/>'+data[FieldCount-1]["desc"] +'</textarea><br>'+
              'Images: <input type="file" name="mytext[]" id="file_'+ FieldCount +'" multiple/><br>'+
              'Rating:   <select name="rating" id="rating_'+ FieldCount+'" value="'+data[FieldCount-1]["rating"] +'">'+
            '<option value="5">5</option>'+
            '<option value="4">4</option>'+
            '<option value="3">3</option>'+
            '<option value="2">2</option>'+
            '<option value="1">1</option>'+
            '<option value="0">0</option>'+
            '</select><br>'+
        'Likes : <input type="number" name="likes" id="likes_'+ FieldCount+'" value="'+data[FieldCount-1]["likes"] +'" min="0"/><br>'+
        'DisLikes : <input type="number" name="dislikes" id="dislikes_'+ FieldCount+'" value="'+data[FieldCount-1]["dislikes"] +'" min="0"/><br>'+
        'Loved : <input type="number" name="loved" id="loved_'+ FieldCount +'" value="'+data[FieldCount-1]["loved"]+'" min="0"/><br>'+
              '<a href="#" class="removeclass" >-Remove</a></div><br>');
            x++; //text box increment
            
            $("#AddMoreFileId").show();
            
            $('AddMoreFileBox').html("Add field");
            
}
}
//on add input buttdata.length;on click
$(AddButton).click(function (e) {
        //max input box allowed
        // if(x <= MaxInputs) {
            //add input box
            $(InputsWrapper).append('<div  id="'+FieldCount+'"><h3><b>Product '+FieldCount+' :</b></h3><br>'+
              'Name: <input type="text" name="name" id="name_'+ FieldCount +'"/><br>'+
              'Prize : <input type="number" name="cost" id="cost_'+ FieldCount +'"/><br>'+
              'Info 1: <input type="text" name="info1" id="info1_'+ FieldCount +'"/><br>'+
              'Info 2: <input type="text" name="info2" id="info2_'+ FieldCount +'"/><br>'+
              'Info 3: <input type="text" name="info3" id="info3_'+ FieldCount +'"/><br>'+
              'Description:<br> <textarea type="text" name="desc" id="desc_'+ FieldCount +'" rows="5" cols="40"/></textarea><br>'+
              'Images: <input type="file" name="mytext[]" id="file_'+ FieldCount +'" multiple/><br>'+
              'Rating:   <select name="rating" id="rating_'+ FieldCount +'">'+
            '<option value="5">5</option>'+
            '<option value="4">4</option>'+
            '<option value="3">3</option>'+
            '<option value="2">2</option>'+
            '<option value="1">1</option>'+
            '<option value="0">0</option>'+
            '</select><br>'+
        'Likes : <input type="number" name="likes" id="likes_'+ FieldCount +'" min="0"/><br>'+
        'DisLikes : <input type="number" name="dislikes" id="dislikes_'+ FieldCount +'" min="0"/><br>'+
        'Loved : <input type="number" name="loved" id="loved_'+ FieldCount +'" min="0"/><br>'+
              '<a href="#" class="removeclass">-Remove</a></div><br>');
            x++; //text box increment
            
            $("#AddMoreFileId").show();
            
            $('AddMoreFileBox').html("Add field");
            
            FieldCount++; //text box added ncrement

            // Delete the "add"-link if there is 3 fields.
            // if(x == 3) {
            //     $("#AddMoreFileId").hide();
            //    $("#lineBreak").html("<br>");
            // }
        // }
        return false;
});

$("body").on("click",".removeclass", function(e){ //user click on remove text
        var num = $(this).parent('div')[0]['id'];
        // if( x > 1 ) {
        if( num>data.length ) {

                $(this).parent('div').remove(); //remove text box
                x--; //decrement textbox
            
              $("#AddMoreFileId").show();
            
              $("#lineBreak").html("");
            
                // Adds the "add" link again when a field is removed.
                $('AddMoreFileBox').html("Add field");
        }
        else{
        num=num-1;
        data.splice(num, 1);
        document.getElementById('InputsWrapper').innerHTML = '';
        getData();
        }


  return false;
});

$(SaveButton).click(function (e) { 
  var a = $('form').serializeArray();
  var arrays = [], size = 10;
    
  while (a.length > 0)
    arrays.push(a.splice(0, size));
    // arrays.push(Object.assign({},a.splice(0, size)));
    var final = [];
  for (var i = 0; i<arrays.length; i++) {
    let obj = {};
    for (var j = 0; j<arrays[i].length; j++) {
      obj[arrays[i][j]['name']] = arrays[i][j]['value'];
    }
    final.push(obj);
  }

  // console.log(final);
  var json = JSON.stringify(final); 

$.ajax({
 type: "POST",
 url: "admin.php",
 data: {'submitData':json},
 dataType: "json",
 success: function(msg) {
 alert('Saved');
 }
});
});

$(AddCat).click(function (e) {
        
    $(InputCat).append('<div id="'+CatCount+'"><input type="text" name="name"/>'+
      '<a href="#" class="removecat">-Remove</a></div><br>');
           CatCount++;
        return false;
});

getCat();
function getCat(){
  for (CatCount = 1; CatCount <= cat.length; CatCount++) {
    $(InputCat).append('<div id="'+CatCount+'"> '+cat[CatCount-1]+
        ' <a href="#" class="removecat">-Remove</a></div><br>');
  }
}

$(SaveCat).click(function (e) {
  console.log("save cat");
  console.log(document.getElementById('AddMoreCatId').getElementsByTagName('input'));
  });

$("body").on("click",".removecat", function(e){ //user click on remove text
        var num = $(this).parent('div')[0]['id'];
        if( num>cat.length ) {

                $(this).parent('div').remove(); //remove text box
               
        }
        else
        {
        num=num-1;
        cat.splice(num, 1);
        document.getElementById('AddMoreCatId').innerHTML = '';
        getCat();
        }


  return false;
});
});
  </script>

  <!-- login -->
<?php
if($loginPage){
  ?>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
<?php
}
else{
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
}
?>

</head>
<body>
<?php
if($loginPage){
  ?>
  <form class="form-signin" action="admin.php" method="post">
      <img class="mb-4" src="images/logo/logo.jpeg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-BOLD">DEKORA HOMES Admin CPannel</h1>
      <!-- <label for="inputEmail" class="sr-only">Email address</label> -->
      <!-- <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus> -->
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <?php
        if($validation==true){
        ?>
        <label class="text-danger">Please check password.</label><br>
        <?php 
        }
       ?>
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2020 <br>All Rights Reserved by <a href="#">Dekora Homes</a>.</p>
    </form>
<?php
}
else{
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
       <img class="mb-4" src="images/logo/logo.jpeg" alt="" width="40" height="40">
      </a>
    </div>
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        DEKORA HOMES [Admin]
      </a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <!-- <li class="active"><a href="#">Content</a></li> -->
      <li><a href="#">Page 1</a></li>
      <!-- <li><a href="#">Page 2</a></li> -->
      <!-- <li><a href="#">Page 3</a></li> -->
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Welcome Mr. Rajesh
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <!-- <li><a href="#">Page 1-1</a></li> -->
          <!-- <li><a href="#">Page 1-2</a></li> -->
          <!-- <li><a href="#">Page 1-3</a></li> -->
          <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Setting</a></li>
          <li><a href="admin.php?action=logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
  
<div class="container" style="margin-top:50px">
  <h1><b>C Pannel</b></h1>
  <div class="row" style="margin-top:50px">
    <div class="col-md-6">
      <table style="border: none;font-weight: bold;">
        <tr>
          <td>Logo:</td>
          <td><input type="file" name=""></td>
          <td><input type="button" name="Update" value="Update"></td>
          <td><img class="mb-4" src="images/logo/logo.jpeg" alt="" width="40" height="40"></td>
        </tr>
      </table>  
    </div>
    <div class="col-md-6"> 
      <p>A fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.</p>
      <p>A fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.</p>
    </div>
    <div class="col-md-6"> 
    <form action="" method="post">
  <div id="InputsWrapper">
    <!-- <div>
      <input type="text" name="mytext[]" id="field_1" value="">
      <a href="#" class="removeclass">Remove</a>
    </div> -->
  </div>
  <br>
  <div id="AddMoreFileId">
    <a href="#" id="AddMoreFileBox" class="btn btn-info">Add More Product</a><br><br>
  </div>
  <div id="lineBreak"></div>
  <a href="#" id="SaveData" class="btn btn-success">Save All Products</a><br><br>
</form>
</div>
<div class="col-md-6"> 
  <h3>Categories: </h3>
  <div id="AddMoreCatId">
    
  </div>
  <a href="#" id="AddMoreCatBox" class="btn btn-info">Add Catagory</a>
  <a href="#" id="SaveCatBox" class="btn btn-success">Save</a>
</div>
</div>
</div>

<?php
}
?>
</body>
</html>
