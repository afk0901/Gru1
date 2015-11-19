/*Tekið frá: http://stackoverflow.com/questions/18640051/js-form-check-empty - aðlagað að kóða*/

function checkform(form) {
    // get all the inputs within the submitted form
    var inputs = form.getElementsByTagName('input');
    var errortext = "Formið má ekki vera tómt. Það sem vantar er rautt.";

    for (var i = 0; i < inputs.length; i++) {
        // only validate the inputs that have the required attribute
        if(inputs[i].hasAttribute("jscheck")){
            if(inputs[i].value == ""){

                
$(inputs[i]).addClass("borderred");
                // found an empty field that is required
                document.getElementById("errortext").innerText = errortext;
                return false;
            }

            else{

$(inputs[i]).removeClass("borderred");
            //$('.borderred').remove();

            //$(inputs[i].addClass("form-control"));
            }
        }
    }
    return true;
}