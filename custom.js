var _IMAGE = document.querySelector("#image-source"),
    _CANVAS = document.querySelector("#image-canvas"),
    _CTX = _CANVAS.getContext("2d");

    var x_axis = 350;
    var y_axis = 250;

_CANVAS.setAttribute("width", x_axis);
_CANVAS.setAttribute("height", y_axis);

_IMAGE.onload = function(){
_CTX.drawImage(_IMAGE, 0, 0, x_axis, y_axis);

var _IMAGE_DATA = _CTX.getImageData(0, 0, _CANVAS.width, _CANVAS.height);
console.log("counting pixels.......................");
var countResults = countPixels(_IMAGE_DATA.data);
//console.log(countResults);
var jsonString = JSON.stringify(countResults);
var base64 = btoa(jsonString);
sendToDb(base64);
}

function countPixels(data) {   
    const colorCounts = {};
    for(let index = 0; index < data.length; index += 4) {
        const rgba = `rgba(${data[index]}, ${data[index + 1]}, ${data[index + 2]}, ${(data[index + 3] / 255)})`;

        if (rgba in colorCounts) {
            colorCounts[rgba] += 1;
        } else {
            colorCounts[rgba] = 1;
        }
    }    
    return colorCounts;
}



/***
console.log(base64);
var actual = JSON.parse(atob(base64));
console.log(actual);
 ****/



 function sendToDb(base64String){
    var settings = {
        "url": "http://localhost/pixel/savetodb.php",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json"
        },
        "data": JSON.stringify({"IMAGE_DATA": base64String}),
      };
      $.ajax(settings).done(function (response) {
        console.log(response);
      });
 }

