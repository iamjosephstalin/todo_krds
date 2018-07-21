<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
body {
  margin: 0;
  min-width: 250px;
}

* {
  box-sizing: border-box;
}

ul {
  margin: 0;
  padding: 0;
}

ul li {
  cursor: pointer;
  position: relative;
  padding: 12px 8px 12px 40px;
  list-style-type: none;
  background: #eee;
  font-size: 18px;
  transition: 0.2s;
  word-wrap: break-word;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

ul li:nth-child(odd) {
  background: #f9f9f9;
}

ul li:hover {
  background: #ddd;
}

ul li.checked {
  background: #888;
  color: #fff;
  text-decoration: line-through;
}

ul li.checked::before {
  content: '';
  position: absolute;
  border-color: #fff;
  border-style: solid;
  border-width: 0 2px 2px 0;
  top: 10px;
  left: 16px;
  transform: rotate(45deg);
  height: 15px;
  width: 7px;
}

.close {
  position: absolute;
  right: 0;
  top: 0;
  padding: 12px 16px 12px 16px;
}

.close:hover {
  background-color: #f44336;
  color: white;
}

.header {
  background-color: #a18482;
  padding: 30px 40px;
  color: white;
  text-align: center;
}

.header:after {
  content: "";
  display: table;
  clear: both;
}

input {
  margin: 0;
  border: none;
  border-radius: 0;
  width: 75%;
  padding: 10px;
  float: left;
  font-size: 16px;
}

.addBtn {
  padding: 10px;
  width: 25%;
  background: #d9d9d9;
  color: #555;
  float: left;
  text-align: center;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 0;
}

.addBtn:hover {
  background-color: #bbb;
}
</style>
</head>
<body>
<?php
    require_once('config.php');
?>
<form id="todo" name="todo" action="insert_data.php" method="post">
<div id="myDIV" class="header">
  <h2 style="margin:5px">Shopping List</h2>
  <input type="text" name= "input" maxlength=100 required pattern="[a-zA-Z0-9-\s]+" id="myInput" placeholder="Whats in your Mind...">
<button type="submit" onclick="<?php if(isset($_SESSION['success'])) { ?>newElement()<?php } ?>" class="addBtn">Add</button>
</div>
</form>
<ul id="myUL">
  <?php
      $sql = "select * from todo_details order by timestamp desc";
      $result = mysqli_query($con,$sql);
      $row = array();
      while ($row =  mysqli_fetch_assoc($result))
      {
  ?>
        <li id="<?php echo $row['list_id']; ?>" <?php if($row['status']=='close') { ?>class="checked" <?php } ?> ><?php echo $row['description']; ?></li>
        
<?php } ?>
</ul>
<br/>
<div style="text-align: center;">
<a class="twitter-share-button"
  href="https://twitter.com/share"
  data-size="large"
  data-text="Hi! Here's my To-Do List Today!!!"
  data-url="https://dev.twitter.com/web/tweet-button"
  data-hashtags="example,demo"
  data-via="twitterdev"
  data-related="twitterapi,twitter">
Tweet Your To Do List
</a>
      </div>
<script>
var myNodelist = document.getElementsByTagName("LI");
var i;
for (i = 0; i < myNodelist.length; i++) {
  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  myNodelist[i].appendChild(span);
}

var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    var id = div.id;
    $.ajax({
        type: "POST",
        url: 'delete_data.php',
        data: {id: id},
        success: function(result){
        if(result=='1'){div.style.display = "none";}      
        }    
        });
  }
}

var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI') {
    var id = ev.target.id;
    $.ajax({
        type: "POST",
        url: 'change_status.php',
        data: {id: id},
        success: function(result){
        if(result=='1'){ ev.target.classList.toggle('checked'); }      
        }    
        });
  }
}, false);

function newElement() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("myUL").appendChild(li);
  }
  document.getElementById("myInput").value = "";

  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  li.appendChild(span);

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}
</script>

</body>
</html>
