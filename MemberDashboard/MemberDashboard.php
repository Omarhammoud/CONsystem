<!DOCTYPE html>
<html>
   <head>
      <title>Member Dashboard</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="Style.css">
   </head>
   <body style="background-color:#DDDFEB">
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
	  <a class="navbar-brand">Dashboard</a>
	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<form class="form-inline my-2 my-lg-0" action="NewPost.html">
			  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Create Post</button>
			</form>
		</div>
	</nav>
      <div class="container" style="width: 50em;">
         <div id="divID">
            <p id="pID">
               <span style="font-size:50px;">👤</span>
               name of post owner
            </p>
            <br>
            <h5 id="h1ID">Lorem ipsum dolor sit amet, consectetur v elit. Mauris at nunc vitae arcu dapibus ultrices et eu sem. Ut suscipit, tortor vel facilisis vestibulum, tellus tortor convallis purus, vel aliquet nibh sem at ligula. Etiam id massa ipsum. Mauris pharetra est eget malesuada hendrerit. Vivamus dapibus facilisis justo id faucibus. Fusce iaculis consequat viverra. Nullam aliquet maximus eros at maximus. Curabitur nec sem eget massa auctor dapibus. Sed luctus dignissim dictum. Maecenas varius sapien at odio lobortis finibus.</h5>
            <img id="imageID" src="image1.jpg">
            <br>
            <br>
            <div class="commentDiv">
               <h6 class="commentOwner">
                  <span class="commentImg" style="margin-left: 10px;background-color: #8c7878;border-radius: 79px;">👤</span>
                  name of comment owner
               </h6>
               <h4 class="comment">this the first comment Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h4>
            </div>
            <div class="commentDiv">
               <h6 class="commentOwner">
                  <span class="commentImg" style="margin-left: 10px;background-color: #8c7878;border-radius: 79px;">👤</span>
                  name of comment owner 2
               </h6>
               <h4 class="comment">this the second comment Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h4>
            </div>
            <form action="commentNameForm.php" name="commentNameForm" method="post">
               <textarea placeholder="Write a comment..." class="commentTextArea" name="commentTextArea" onkeyup="textAreaAdjust(this)"></textarea>
               <br>
               <br>
               <button class="commentName" type="submit" onclick="VisibilityMethod()">Comment
               <i class="far fa-comment" aria-hidden="true"/>
               </button>
            </form>
         </div>
         <div id="divID">
            <p id="pID">
               <span style="font-size:50px;">👤</span>
               name of post owner
            </p>
            <br>
            <h5 id="h1ID">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at nunc vitae arcu dapibus ultrices et eu sem. Ut suscipit, tortor vel facilisis vestibulum, tellus tortor convallis purus, vel aliquet nibh sem at ligula. Etiam id massa ipsum. Mauris pharetra est eget malesuada hendrerit. Vivamus dapibus facilisis justo id faucibus. Fusce iaculis consequat viverra. Nullam aliquet maximus eros at maximus. Curabitur nec sem eget massa auctor dapibus. Sed luctus dignissim dictum. Maecenas varius sapien at odio lobortis finibus.</h5>
            <br>
            <br>
            <div class="commentDiv">
               <h6 class="commentOwner">
                  <span class="commentImg" style="margin-left: 10px;background-color: #8c7878;border-radius: 79px;">👤</span>
                  name of comment owner 4
               </h6>
               <h4 class="comment">this the first comment of this post Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h4>
            </div>
            <form action="commentNameForm.php" name="commentNameForm" method="post">
               <textarea placeholder="Write a comment..." class="commentTextArea" name="commentTextArea" onkeyup="textAreaAdjust(this)"></textarea>
               <br>
               <br>
               <button class="commentName" type="submit" onclick="VisibilityMethod()">Comment
               <i class="far fa-comment" aria-hidden="true"/>
               </button>
            </form>
         </div>
         <div id="divID">
            <p id="pID">
               <span style="font-size:50px;">👤</span>
               name of post owner
            </p>
            <br>
            <img id="imageID" src="image2.jpg">
            <br>
            <br>
            <button class="commentName" type="submit" onclick="VisibilityMethod()">Comment
            <i class="far fa-comment" aria-hidden="true"/>
            </button>
            <form action="commentNameForm.php" name="commentNameForm" method="post">
               <textarea placeholder="Write a comment..." class="commentTextArea" name="commentTextArea" onkeyup="textAreaAdjust(this)"></textarea>
            </form>
			
			<br><br>
			
			<div id="poll">
				<h3>
					general meetings, agenda or resolution to be voted
				</h3>
				<form>
					yes <input type="radio" name="vote" value="0" onclick="getVote(this.value)"><br>
					no <input type="radio" name="vote" value="1" onclick="getVote(this.value)"><br>
				</form>
			</div>
			
			
         </div>
      </div>
	  <script>
	  function VisibilityMethod() 
	  { 
		  alert(this); 
		  if (this.style.display === "none") 
		  { this.style.display = "block"; } 
		  else { this.style.display = "none"; } 
	  } 
	  function textAreaAdjust(element) 
	  { 
		  element.style.height = "1px"; 
		  element.style.height = (25+element.scrollHeight)+"px"; 
	  }
	  
	  function getVote(int) 
	  {
		  var xmlhttp=new XMLHttpRequest();
		  xmlhttp.onreadystatechange=function() 
		  {
			if (this.readyState==4 && this.status==200) 
			{
			  document.getElementById("poll").innerHTML=this.responseText;
			}
		  }
		  xmlhttp.open("GET","poll_vote.php?vote="+int,true);
		  xmlhttp.send();
	   }
	  </script>
   </body>
</html>