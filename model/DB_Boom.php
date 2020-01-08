<?
// $unique is a boolean value indicating if the recordsSelected must be $unique
// $columns is an array of field  headings to  gather data FROM
// $table tells what table the  data is  taken FROM
// $orderBy
// $where
// $upDown
// $limit

function addDivider($array,$commaStr,$divStr){
  $i=0;
  foreach($array as $arrayElement){
    if($i ==0){
      $commaStr.= $arrayElement;
    }else if($i ==count($columns)){
      $commaStr.= $arrayElement;
    }else{
      $commaStr.= $arrayElement.$divStr;
    }
    $i++;
  }
  return $commaStr;
}

function insertRecords($insertColumnData,$insertColumnNames, $tableName){
  global $db;
  $query = 'INSERT INTO '.$tableName . ' (';
  $j=0;
  for($i =0;$i<count($insertColumnNames);$i++){
      //Appends comma at begining only after first columnData
    if($i!=0){
      $query.=",";
    }else{$query.="(";}
    $query.=':'.$insertColumnNames[i];
    if($i==(count($insertColumnNames)-1)){
      $query.=')VALUES ';
    }
  }
  for($i =0;$i<count($insertColumnData);$i++){
      //Appends comma at begining only after first columnData
    if($i != count($insertColumnNames)%0){
      $query.=",";
    }else{$query.="(";}

    $query.=':'.$insertColumnData[i];
    if($i==(count($insertColumnNames)-1)){
      $query.=")";
    }
  }

  $j=0;
  foreach($insertColumnData as $columnData){
    //Appends comma at begining only after first columnData
    if($j!=0){
      $query.=",";
    }
    $query.=':'.$columnData;
    $j++;
  }
  $query.=")";
  $statement = $db->prepare($query);
  for($i=0;i<count($insertColumnNames);$i++){
    $statement->bindValue(':'.$insertColumnNames[i],$insertColumnNames);
  }
  $statement->execute();
  $user_id = $db->lastInsertId();
  $statement->closeCursor();
  return $user_id;
}

function selectRecords($unique,$columns,$table,$orderBy,$where,$upDown,$limit){
  global $db;
  $columnStr="";
  $orderByStr="";
  $whereStr="";
  $uniqueStr="";
  if($unique){$uniqueStr = "DISTINCT";}
  else{$uniqueStr = "";}
  $columnStr="";
  if($columns[0]=="*"||$columns[0]=="ALL"){
    $columnStr="*";
  }else{
    $columnStr = addDivider($columns,$columnStr,",");
  }
  if($orderBy[0] ==""){
    $orderByStr="";
  }else{
    $orderByStr="ORDER BY ";
    $orderByStr=addDivider($orderBy,$orderByStr,",");
  }
  if($where[0]==""){
    $whereStr="";
  }else{
    $whereStr="WHERE";
    $whereStr=addDivider($where,$whereStr,"AND");
  }

  $query = "SELECT ".$uniqueStr." ".$columnStr." FROM ".$table[0]." ".
            $orderByStr . " " .$whereStr;
  try {
      $statement = $db->prepare($query);
      foreach($where as $whereThing){
        $statement->bindValue(':'.$whereThing, $whereThing);
      }
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      $statement->closeCursor();
      return $result;
  } catch (PDOException $e) {
      $error_message = $e->getMessage();
      display_db_error($error_message);
  }
}
?>
