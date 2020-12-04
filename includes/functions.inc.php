<?php
   //Written By: Israt Noor Kazi (40029299)
?>
<?php
 
//Function check of the user is part of the group
function isPartOfGroup($array_ids,$memberID){
    foreach ($array_ids as $id){
        if (isset($id["MemberID"]) && $id["MemberID"] == $memberID ){
            if( $id['Status']!="In Progress"){
                return 2; // Member is accepted in the group
            }
            return 1; // Member send a request which is in progress 
        }      
    }
    return 0; // Member is not part of group
}

?>