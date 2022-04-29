var objToRemove;

function editTODO(id)
{
    var inputs = document.getElementsByClassName('input'+id);
    for(x=0; x<inputs.length; x++)
    {
        inputs[x].removeAttribute('readonly');
    }
    var button = document.getElementById('button'+id);
    button.innerText = "Zapisz";
    button.setAttribute('onclick', "saveEdit("+id+")");
}
function saveEdit(id)
{
    var button = document.getElementById('button'+id);
    //console.log(button);
    button.innerText = "Edytuj";
    button.setAttribute('onclick', "editTODO("+id+")");
    var inputs = document.getElementsByClassName('input'+id);
    for(x=0; x<inputs.length; x++)
    {
        inputs[x].setAttribute('readonly', "true");
    }
    
    var details = inputs[1].value;
    var title = inputs[0].value;
    $.ajax
    ({
        async: false,
        url:"crud/Edit.php",
        method: "POST",
        data:
        {
            id:id,
            details:details,
            title:title
        },
        success:function(out)
        {
            alert(out);
        }
    })
}

function RemoveTODO(id)
{
    var button = document.getElementById('button'+id);
    console.log(button);
    button.innerText = "Edytuj";
    button.setAttribute('onclick', "editTODO("+id+")");
    var inputs = document.getElementsByClassName('input'+id);
    objToRemove = document.getElementById(id);
    for(x=0; x<inputs.length; x++)
    {
        inputs[x].setAttribute('readonly', "true");
    }
    
    var details = inputs[1].value;
    var title = inputs[0].value;
    $.ajax
    ({
        async: false,
        url:"crud/Remove.php",
        method: "POST",
        data:
        {
            id:id
        },
        success:function(out)
        {
            alert(out);
            if(out=="usunięto")
            {
                console.log(out);
                objToRemove.remove();
            }
        }
    })
}

function createTODO(user)
{
    var place = document.getElementById("place");
    var table = document.getElementById("table");
    var button = '<tr id="place"><td><div><div class="form-group"><button type="button" class="button" name="submit" onclick=createTODO('+user+')>Nowe Zadanie</button></div></div></td></tr>';
    $.ajax
    ({
        async: false,
        url:"crud/Create.php",
        method: "POST",
        data:
        {
            user:user
        },
        success:function(out)
        {
            place.remove();
            table.innerHTML+=out;
            table.innerHTML+=button;
        }
    })
}