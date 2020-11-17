<?php 

function isPartOfGroup($array_ids,$memberID){
    foreach ($array_ids as $id){
        if (isset($id["MemberID"]) && $id["MemberID"] ==$memberID ){
            return true;
        }      
    }
    return false;
}

?>