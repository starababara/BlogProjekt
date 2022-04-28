<?php
        
        if(isset($_POST['user']))
        {
            require_once("../config/db.php");
            $usr = $_POST['user'];
            $sql="INSERT INTO todo (ID, userID) VALUES (NULL, :user)";
            $query=$db->prepare($sql);
            $query->bindValue(':user', $usr , PDO::PARAM_INT);
            $query->execute();

            $sql="SELECT * FROM todo WHERE userID=:user";
            $query=$db->prepare($sql);
            $query->bindValue(':user', $usr , PDO::PARAM_INT);
            $query->execute();
            $allcount = $query->rowCount();
            
            for($todoNumber = $allcount; $todoNumber>0; $todoNumber--)//wybiera najwyższe ID
            {
                while($todoRow = $query->fetch()) 
                {
                    $allcount = $todoRow['ID'];
                }
            }
            $out='
                <tr id='.$allcount.'>
                    <td>
                        <div>
                            <input type="text" readonly value="" class="input'.$allcount.'"></br>
                            <textarea class="input'.$allcount.'" readonly></textarea></br>
                            <div class="form-group">
                                <button type="button" class="tableButton '.$allcount.'" id="button'.$allcount.'" name="submit" onclick=saveEdit('.$allcount.')>Zapisz</button>
                                <button type="button" class="tableButton" name="submit" onclick=RemoveTODO('.$allcount.')>usuń</button>
                            </div>
                        </div>    
                    </td>
                </tr>';
        }
        echo $out;
    ?>