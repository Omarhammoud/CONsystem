<?php include 'header.php'; ?>
<?php
    
        require "dbh.inc.php";
        $contentID = 1;
        $sql = "SELECT `event_poll_optionID`, `ContentID`, `Place`, `Date`, `Time` FROM `event_poll_option` WHERE `ContentID`=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./index.php?error=sqlerror1");
            exit();
            }

        mysqli_stmt_bind_param($stmt, "i",$contentID);
        mysqli_stmt_execute($stmt);
        $options = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);        
 

?>
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
            <!--Format for a comment -->
            <form class='comment-form'>
               <textarea placeholder="Write a comment..." class="commentTextArea" name="commentBody" onkeyup="textAreaAdjust(this)"></textarea>
               <br>
               <input type="hidden" name="contentID" value=<?php echo $contentID; ?>>
               <input type="submit">
            </form>
            
            
            <!--Display comments after fetch data -->
            <div id=<?php echo 'comments_list_'.$contentID; ?>>
            
            </div>
            

         
		
         <!--Format for a poll -->
			<div id=<?php echo 'event_poll_'.$contentID?>>
				<h3>
					general meetings, agenda or resolution to be voted
            </h3>
            <!--Format for a poll form-->
				<form class="event_poll_form">
               <?php while($option = mysqli_fetch_assoc($options)){ ?>
                  <div>
                     <input type="radio" name="vote" value = <?php echo $option['event_poll_optionID']?>>
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
               <input type="hidden" name="contentID" value="<?php echo $contentID; ?>">
               <input type="submit" class="btn btn-primary btn-sm" value="Submit">
				</form>
			</div>
			
      </div>

<?php include 'footer.php'; ?>

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

     
     $(document).ready(function(){
           
         $(".comment-form").submit(function(event){
            event.preventDefault(); //prevent default action
            var form_data = $(this).serialize(); //Encode form elements for submission
            $(this).find('textarea').val("");

            $.post( './postComment.inc.php', form_data, function( response ) {
                 var data = JSON.parse(response)
                  
                if('err' in data){
                    alert(data.err);
                 }else{
                    displayAllComments(data['contentID']); 
                 }
              });
           });

         function displayAllComments(contentID){
 
            $.get('./displayComments.inc.php?cid='+contentID,function(response){
              $("#comments_list_"+contentID).html(response);
           })
         }

         $(".event_poll_form").submit(function(event){
            event.preventDefault(); 
            var form_data = $(this).serialize(); 

            $.post( './poll_vote.php', form_data, function( response ) {
               var data = JSON.parse(response)                  
               if('err' in data){
                   alert(data.err);
                }else{
                  displayPollResults(data['contentID']); 
                }
              });
            });

         function displayPollResults(contentID){

            $.get('./display_poll_results.php?cid='+contentID,function(response){
              $("#event_poll_"+contentID).html(response);
            })
         }
      });
</script>