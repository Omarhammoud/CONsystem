<!--
	Written By: Miled Chalal-Henri (26685900)
-->
<?php include "header.php"?>

<?php
	if(!isset($_SESSION['MemberID'])){
		header("Location: ./LoginPage.php");
	}
?>

		
		<form id="post_form" action="./insertPost.php" METHOD="post" onsubmit="return checkIfTitleExists()" enctype="multipart/form-data">
		
			<div id="privacyOption">
			  <p>Select Post Privacy:</p>
			  <input type="radio" id="publicPost"  name="postPrivacy" value="public" onclick="ShowHidePrivateMembers()" checked>
			  <label for="public">public</label><br>
			  <input type="radio" id="privatePost" name="postPrivacy" value="private" onclick="ShowHidePrivateMembers()">
			  <label for="private">private</label><br>
			
			
				<div id="dvtext" style="display: none">
				
				
				<?php
					require "dbh.inc.php";
					// TO REPLACE WITH A SESSION VARIABLE FOR THE MEMBERID
					$memberID = $_SESSION['MemberID'];
					
					$sql = "SELECT GroupID FROM part_of WHERE MemberID=$memberID";
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
					if ($groupID = $row['GroupID']) {
						$sql = "SELECT MemberID FROM part_of WHERE GroupID=$groupID";
						$res = $conn->query($sql);
						
						if ($res->num_rows > 0) {
							$i = 1;
							while ($members = $res->fetch_assoc()) {
								$member_ID = $members['MemberID'];
								if ($member_ID != $memberID) {
									$sql = "SELECT Name FROM member WHERE MemberID=$member_ID";
									$final_result = $conn->query($sql);
									if ($final_result->num_rows > 0) {
										$val = $final_result->fetch_assoc();
										$name = $val['Name'];
										echo '<input type="checkbox" id="member'.$i.'" name="privateMember['.$i.']" value="'.$member_ID.'">';
										echo '<label for="'.$member_ID.'">&nbsp'.$name.'</label><br>';
									}									
								}
								$i++;
							}
						}
					}
					
				?>
					
				</div>
			</div>

			<div class="center">
				<textarea placeholder="Insert text content here..." type="text" id="textPost" name="content" onkeyup="textAreaAdjust(this)"></textarea>
				<input type="hidden" name="hasPoll" id="has_poll" value="false">
				<br/><br/>
				<input type="file" id="files" class="newPostImg"  name="img" accept="image/x-png,image/gif,image/jpeg" />
				<br/><br/>
				<div id="PollDivID" style = 'display: none'>
					<input type="text" class="PollTitle"  name="pollTitle" id="pollTitle" placeholder="Enter Poll Title">
					<input type="text" class="PollOption"  name="pollOptPlace[1]" placeholder="Enter place option 1" id="1">
					<input type="text" class="PollOption"  name="pollOptPlace[2]" placeholder="Enter place option 2" id="2">	
					<div id="optDate">
						<input type="date" id="1 date" class="PollOptionDate" name="pollOptDate[1]">
						<input type="date" id="2 date" class="PollOptionDate" name="pollOptDate[2]">					
					</div>
					<div id="optTime">
						<input type="time" id="1 time" class="PollOptionTime" name="pollOptTime[1]">
						<input type="time" id="2 time" class="PollOptionTime" name="pollOptTime[2]">
					</div>
				</div>
				<input type="submit" id="postBtn" value="Post">
			</div>
		</form>
		
		<button id="btnVote" onclick="Toggle(this)"> Create a poll</button>
		<button id="removeOption" class="removeOptionClass" onclick="removeOption()" style = 'display: none'> Remove option </button>
		<button id="addOption" class="addOptionClass" onclick="AddOption()" style = 'display: none'> Add option </button>
	  <script>
	var numberOfOptions = 3; 
	var hasPoll = false;
	
	function checkIfTitleExists(){
	
		if(document.getElementById("pollTitle").value === "" && document.getElementById("has_poll").value === "true"){
			alert("Please Add a Title");
			return false;
		}else{
			return true;
		}
	}
	function textAreaAdjust(element) 
	{ 
	  element.style.height = "1px"; 
	  element.style.height = (25+element.scrollHeight)+"px"; 
	}
	function Toggle(e) 
	{
	hasPoll = !hasPoll;
	document.getElementById("has_poll").innerHTML = hasPoll;
	document.getElementById("has_poll").value = hasPoll;
	  var addOption = document.getElementById("addOption");
	  var div = document.getElementById("PollDivID");
	  var removeOption = document.getElementById("removeOption");
	  if (div.style.display === "none") 
	  {
		div.style.display = "block";
	  } 
	  else 
	  {
		div.style.display = "none";
	  }
	  if (addOption.style.display === "none") 
	  {
		addOption.style.display = "block";
	  } 
	  else 
	  {
		addOption.style.display = "none";
	  }
	  if (removeOption.style.display === "none") 
	  {
		removeOption.style.display = "block";
	  } 
	  else 
	  {
		removeOption.style.display = "none";
	  }
	}
	function removeOption()
	{
		if(numberOfOptions >= 2){
		removeElement( document.getElementById(numberOfOptions-1) );
		removeElement(document.getElementById(numberOfOptions -1 +" time"));
		removeElement(document.getElementById(numberOfOptions -1 +" date"));
		numberOfOptions--;
		}
	}
	function AddOption()
	{
		if(numberOfOptions <= 5){
		var container = document.getElementById("PollDivID");
		var pollTitleEle = document.createElement("input");
		pollTitleEle.className = "PollOption";
		pollTitleEle.type = "text";
		pollTitleEle.name = "pollOptPlace[" + numberOfOptions + "]";
		pollTitleEle.placeholder = "Enter place option " +(numberOfOptions);
		pollTitleEle.id = numberOfOptions;
		container.appendChild(pollTitleEle);
		var offset = 42;
		document.getElementById("btnVote").top = document.getElementById("btnVote").top - offset;
		
		var containerDate = document.getElementById("optDate");
		var pollTitleEleDate = document.createElement("input");
		pollTitleEleDate.className = "PollOptionDate";
		pollTitleEleDate.type = "date";
		pollTitleEleDate.name = "pollOptDate[" + numberOfOptions + "]";
		pollTitleEleDate.id = numberOfOptions + " date";
		containerDate.appendChild(pollTitleEleDate);
		var offset = 42;
		document.getElementById("optDate").top = document.getElementById("optDate").top - offset;
		var containerTime = document.getElementById("optTime");
		var pollTitleEleTime = document.createElement("input");
		pollTitleEleTime.className = "PollOptionTime";
		pollTitleEleTime.type = "time";
		pollTitleEleTime.name = "pollOptTime[" + numberOfOptions + "]";
		pollTitleEleTime.id = numberOfOptions + " time";
		containerTime.appendChild(pollTitleEleTime);
		var offset = 42;
		numberOfOptions++;
		document.getElementById("optTime").top = document.getElementById("optTime").top - offset;		
		}
	}
	function removeElement(element) 
	{
    element && element.parentNode && element.parentNode.removeChild(element);
	}
	function ShowHidePrivateMembers() 
	{
        var privatePost = document.getElementById("privatePost");
        var dvtext = document.getElementById("dvtext");
        dvtext.style.display = privatePost.checked ? "block" : "none";
    }

	  </script>

<?php include "footer.php"?>
