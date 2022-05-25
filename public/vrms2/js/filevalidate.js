function validate()
{
 
var _validFileExtensions = [".jpg", ".jpeg", ".png" , ".pdf"];
var arrfilenames = new Array();

var arrInputs = myForm.getElementsByTagName("input");
      for (var i = 0; i < arrInputs.length; i++) {
          var oInput = arrInputs[i];
          if (oInput.type == "file") {
              var sFileName = oInput.value;
              if (sFileName.length > 0) {
                  var blnValid = false;
                  for (var j = 0; j < _validFileExtensions.length; j++) {
                      var sCurExtension = _validFileExtensions[j];
                      if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                          blnValid = true;
                          break;
                      }
                  }
                  
                  if (!blnValid) {
                      alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                      return false;
                  }
              }
          }
      }

      
var s= 0;

for (var i=0, j=myForm.elements.length; i<j; i++)
      {
        myType = myForm.elements[i].type;
        if (myType == 'file')
        {
              arrfilenames[s]= myForm.elements[i].value;
              s++;
        }
      }
      
  for(var m=0;m < arrfilenames.length; m++)
  {

  for( var l = m +1;l<arrfilenames.length;l++)
  
  {
    if(arrfilenames[m] != ""){
      if (arrfilenames[m] == arrfilenames[l])
    {
    alert($(".duplicate_file").val());
    return false;
    }
    }
  }
  }
return true;
}

function validateEdit()
{
 
var _validFileExtensions = [".jpg", ".jpeg", ".png" , ".pdf"];
var arrfilenames = new Array();

var arrInputs = editForm.getElementsByTagName("input");
      for (var i = 0; i < arrInputs.length; i++) {
          var oInput = arrInputs[i];
          if (oInput.type == "file") {
              var sFileName = oInput.value;
              if (sFileName.length > 0) {
                  var blnValid = false;
                  for (var j = 0; j < _validFileExtensions.length; j++) {
                      var sCurExtension = _validFileExtensions[j];
                      if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                          blnValid = true;
                          break;
                      }
                  }
                  
                  if (!blnValid) {
                      alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                      return false;
                  }
              }
          }
      }

      
var s= 0;

for (var i=0, j=editForm.elements.length; i<j; i++)
      {
        myType = editForm.elements[i].type;
        if (myType == 'file')
        {
              arrfilenames[s]= editForm.elements[i].value;
              s++;
        }
      }
      
  for(var m=0;m < arrfilenames.length; m++)
  {

  for( var l = m +1;l<arrfilenames.length;l++)
  
  {
    if(arrfilenames[m] != ""){
      if (arrfilenames[m] == arrfilenames[l])
    {
      alert($(".duplicate_file").val());
    return false;
    }
    }
  }
  }
return true;
}
