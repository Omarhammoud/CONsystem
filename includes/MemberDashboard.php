<?php include 'header.php'; ?>
<?php
    
        require "dbh.inc.php";
        $contentID = 1;
        $sql = "SELECT `event_poll_optionID`, `ContentID`, `Place`, `Date`, `Time` FROM `event_poll_option` WHERE `ContentID`=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
            exit();
            }

        mysqli_stmt_bind_param($stmt, "i",$contentID);
        mysqli_stmt_execute($stmt);
        $options = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);        
 

?>

      <a href="NewPost.html" class="btn btn-outline-success my-2 my-sm-0">Create Post</a>
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
            <form action="" name="commentNameForm" method="post">
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
            <form action="" name="commentNameForm" method="post">
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
            <form action="" name="commentNameForm" method="post">
               <textarea placeholder="Write a comment..." class="commentTextArea" name="commentTextArea" onkeyup="textAreaAdjust(this)"></textarea>
            </form>
			
			<br><br>
			
			<div id=<?php echo $contentID?>>
				<h3>
					general meetings, agenda or resolution to be voted
				</h3>
				<form >
               <?php while($option = mysqli_fetch_assoc($options)){ ?>
                  <div>
                     <input type="radio" name="vote" onclick="setVote(<?php echo $option['event_poll_optionID']?>,<?php echo $contentID?>)">
                     <label>
                           <?php echo $option['Date'];?>
                           <br>
                           <?php echo $option['Time'];?>
                           <br>
                           <?php echo $option['Place'];?>
                           <br>
                     </label>
                  </div>
               <?php }?>
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

	  
	  function setVote(optionID, contentID) 
	  {
		  var xmlhttp=new XMLHttpRequest();
		  xmlhttp.onreadystatechange=function() 
		  {
			if (this.readyState==4 && this.status==200) 
			{
			  if(this.responseText){
              displayPollResults(contentID);
           }
			}
		  }
		  xmlhttp.open("get","poll_vote.php?oid="+optionID,true);
		  xmlhttp.send();
	   }

      function displayPollResults(contentID) 
	  {
		  var xmlhttp=new XMLHttpRequest();
		  xmlhttp.onreadystatechange=function() 
		  {
			if (this.readyState==4 && this.status==200) 
			{
			  document.getElementById(contentID).innerHTML=this.responseText;
			}
		  }
		  xmlhttp.open("get","display_poll_results.php?cid="+contentID,true);
		  xmlhttp.send();
	   }
     </script>
     
<?php include 'footer.php'; ?>