$(document).ready(function(){
    $("#save").on("click",function(e){
        if (checkfields()==false){
            alert("please fill all fields");
        }else if(checkname()==false){
            alert("your name must be just letters");
        }else if(checklastname()==false){
            alert("your last name must be just letters");
        }else{
        
            e.preventDefault();
            $.ajax({
                method:"POST",
                url:"save_user.php",
                data:{name:$('#name').val(),
                lastname:$('#LastName').val(),
                birthday:$('#birthday').val(),
                gender:$('input[name=gender]:checked').val(),
                city:$('#city').val()},

                success:function(data,one,two){
                
                    if(data==1){
                        
                        alert('save successfully'); 
                        
                    }
                    else if(data==10){
                        
                        alert('This user already exist');

                    }
                        
                        
                }

                
            });
        }    
    });
})
function checkfields(){
    if($("#name").val() == "" & $("#LastName").val() == "" & $("#birthday").val() == "" & $("input[name=gender]:checked").val() == "" & $("#city").val() == ""){
        return false;
    }else if
        ($("#name").val() == "" || $("#LastName").val() == "" || $("#birthday").val() == "" || $("input[name=gender]:checked").val() == "" || $("#city").val() == ""){
        return false;
        
    }else{
        return true;
    } 
}

function checkname(){
    var cond = /^[A-Za-z]+$/;
    var name = $("#name").val();
    var valiname = cond.test(name);
    
    if(!valiname){     
        return false;
    }
    else{
        
        return true; 
    }
}

function checklastname(){
    var cond = /^[A-Za-z]+$/;
    var name = $("#LastName").val();
    var valiname = cond.test(name);
    
    if(!valiname){     
        return false;
    }
    else{
        
        return true; 
    }
}
