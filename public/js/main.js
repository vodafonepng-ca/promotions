"use strict";

$(document).ready(()=>{

    
})
    $("#Back").on("click",()=>{
        window.location.replace("/promotions-v.2/draws/");
    })
let date = new Date()
let year = date.getFullYear();
$("#year").html(year)
var text;
var drawCount = 0;
let arr = new Array(), arrRandCopy = new Array(), rsults = new Array();
var removed;
const dataFile = document.getElementById("dataFile");
const dropdown = document.getElementById("dropdown");
const values = document.getElementById("values");
const namesbox = $("#namesbox");
$("#reset").on("click", function () {
    reset();
})
$("#enterDraw").on("click", () => {
    $("#enterDraw").hide()
    $("#main-nav").show()
})
$("#modal-1-close").on("click", function () {
    $("#modal-1").fadeOut("slow")
    $("#header").slideDown("slow")
})
$("#nameList").on("click", () => {

    if (arr.length === 0) {
        $(dropdown).fadeIn("slow")
        $("#headline").html("No Entries Available")
        setTimeout(()=>{
            $("#headline").html("")
        },1000)
    } else {
      $("#entries").html(`${arr.length} Entries Available `)
      $("#entries").show()
        $(dropdown).fadeIn("slow")
        $(namesbox).fadeIn("slow")
        $(namesbox).removeAttr("disabled")
        $('#headline').slideUp();
        console.log(arr.length)
    }
})
$("#upload").on("click", () => {
    // loadentries
    $("#dataFile").click()
})

$("#loadentries").on("click", () => {
    loadEntries()
})

$("#go-btn").on("click", () => {
    $("#shw-results").show()
    Draw()
})
$("#shw-results").on("click", () => {
    $("#modal-1-body").html("")
    $("#modal-1").fadeIn("slow")
    if(rsults.length===0){
        $("#modal-1-body").html("<p>No results Available</p>")
    }else{
        $("#modal-1-body").html(`<div>${rsults.length} Lucky Winners <button class='btn btn-primary float-right' id='dlbtn' onClick='DownloadResults()'> <i class="bi bi-download"></i> Download Results</buttton> </div><hr>`)

    for (let i = 0; i < rsults.length; i++) {
        $("#modal-1-body").append(`<div class='card shadow-sm border-primary mb-2'><div class="card-body text-center"><span class="h1 text-secondary"> DRAW# ${i + 1}: ${rsults[i]}</span></div></div>`)
    }
    }
})
$("#save-and-update").on("click", () => {
    $(namesbox).attr('disabled', 'disabled');
    saveEntries()
})
$("#dataFile").on("change", () => {
    $("#fileLoadingForm").submit();
})

$("#instructions").on("click", function(e){
  e.preventDefault();
  $.ajax({
    type:"GET",
    url:"index.php?pa=instructions",
    beforeSend:()=>{},
    success:(response)=>{
      $("#modal-1-body").html(response)
      $("#modal-1").fadeIn("slow")
    }
  })
})


$("#fileLoadingForm").on("submit", function (e) {
  // Prevent the defaul form submision action
  e.preventDefault();
    $(dropdown).fadeIn("slow");
/*Asyncrouosuly submit the form data to the server*/
    $.ajax({
        type: 'POST',
        url: '/promotions-v.2/api/loadcsv',
        data: new FormData(this),
        dataType: false,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: () => {
            $("#entries").html("<img src='/promotions-v.2/public/images/bars.svg'/>")
            $("#entries").append("<p>Uploading File...<p>")
        },
        success: (response) => {


            let resData=JSON.parse(response);
          if(resData.status==="error"){
            alert(resData.message)
            $("#entries").html("")
          }else {
            $("#entries").html("Data file Uploaded")
            loadEntries()
          }
        },
        error:(err)=>{
          alert(err.message)
        }
    });
})

function DownloadResults(){
    const now = new Date();
    const ye=now.getFullYear();
    const mon=now.getMonth();
    const day=now.getDay();
    const hour=now.getHours();
    const min=now.getMinutes();
    const sec=now.getSeconds();
    const fileName="Draw-"+ye+""+mon+""+day+""+hour+""+min+""+sec+".csv";
    const dt=rsults
    $.ajax({
        type: 'POST',
        url: '/promotions-v.2/api/downloadcsv',
        data:{results:dt} ,
        beforeSend: () => {
        },
        success: (response) => {
            var blob = new Blob([response])
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
        link.download = fileName;
        link.click();
        $("#modal-1-body").html("");
        $("#modal-1").fadeOut("slow")
        },
        error:(err)=>{
            console.log(err.message)
        }
    })
}

/**
this function runs the the draw and piks out a random number from the main data array ie, arr

 */
function Draw() {
    $("#entries").fadeOut("slow")
    $("#nav-buttons").removeClass("even-4");
    $("#nav-buttons").addClass("even-5");
    drawCount = drawCount + 1;
    /*Make a random copy of the Main  Data Arra*/
    arrRandCopy = makeRandArrayCopy(arr);
    if ($(namesbox).val() === ''||arr.length === 0) {
        alert("No Entries at the Moment")
    } else {
        $("#go-btn").attr('disabled', 'disabled')
        $("#nameList").attr('disabled', 'disabled')
        $("#shw-results").attr('disabled', 'disabled')
        $('#headline').hide();
        const randIndex = Math.round(Math.random() * arr.length)
        const atrelem = arr[randIndex];
        if (arr[randIndex] === "" |arr[randIndex] === undefined) {
        } else {
            var ind = arr.indexOf(arr[randIndex]);
            // arr.splice(ind, 1)
            text = atrelem;
            let count = 1;
            count = 1;
            // console.log(arr[randIndex])
            // console.log(arr[ind])
            $("#values").show();
            $(".name").show();
            $("#dropdown").show();
            $("div").remove(".name");
            $("div").remove(".extra");

            $(namesbox).slideUp(100)
            let newtop = arrRandCopy.length * 200 * -1;
            $('#values').css({ top: + newtop });
            arrRandCopy.sort(randOrd);
            for (var i in arrRandCopy) {
                if (arrRandCopy[i] ==="" || typeof (arrRandCopy[i]) ===undefined) {
                    count = count - 1;
                } else {
                    const name = arrRandCopy[i];
                    $('#values').append('<div id=result' + count + ' class=name>' + name + '</div>');
                }
                count = count + 1;
            }
            for (var i in arrRandCopy) {
                if (arrRandCopy[i] == "" || typeof (arrRandCopy[i]) == undefined) { } else {
                    const name = arrRandCopy[i];
                    $('#values').append('<div  class=name>' + name + '</div>');
                }
                count = count + 1;
            }

            if (arr.length !==0) {
                removed = arr.splice(arr.indexOf(text), 1)
            } else {
                alert("No Entries available")
            }
            setTimeout(() => {
                $('#values').animate({ top: '0' }, 4000);
            }, 100)
            setTimeout("standout(text,drawCount)", 4000);
        }
    }
}

/**
 this is the function that does the actual animation
 */
function standout(text, count) {
    $('.name').animate({ opacity: 100 });
    $('#result1').animate({ height: '+=600px' }, "fast");
    $('#result1').html(`<p class='animate-charcter'>${text}</p>`)
    $('#result1').append('<p><a class="btn btn-primary" href="#" onClick="removevictim();"><i class="bi bi-save"></i> Save Winner</a> <a class="btn btn-outline-dark" href="#" onClick="Drawagain();"><i class="bi bi-repeat"></i> Pick Again</a></p>');

    $('#go').removeAttr('disabled', 'disabled');
    $('#list').removeAttr('disabled', 'disabled');
    $('#save').removeAttr('disabled', 'disabled');
    $('#headline').html(`<p class='animate-charcter'>Winner # ${count} </p>`);
    $('#headline').show();
}

/**
 * function that removes the displayed winner and saves the resultto the result array
 */

function removevictim() {
    save();
    setTimeout(() => {
        $('#result1').animate({ top: '0' }, 4000);
        $("div").remove("#result1");
        $("div").remove(".name");
        $("div").remove(".extra");
        $("#values").html("");
        $('#headline').html('<p class="text-success " id="saved-txt">Winner Saved</p><p class="text-primary"> Click GO for next roll.<p>');
    }, 1000)
}


/**
 *
 this function makes  coppies of 5000 main array elements from a randomly selected start index
 into and array just to use it for the animation.
 this to reduce loading time onto the DOM and to start the animation as fast as posible
 *
 */
function makeRandArrayCopy(a) {
    const randIndex = Math.round(Math.random() * a.length);
    let ca = "";
    if (randIndex !== a.length && a.length <= 5000 && randIndex < 500) {
        ca = a.slice(randIndex, 500);
    } else {
        if (randIndex !== a.length && a.length > 5000 && randIndex < 500) {
            ca = a.slice(randIndex, 500);
        } else {
            ca = a.slice(0, 500);
        }
    }
    return ca;
}
function randOrd() {
    return (Math.round(Math.random()) - 0.5);
}

/*
this function saves abd updates the main data array with the values of the text box
*/
function saveEntries() {
    var nameupdated = "";
    $("#go-btn").removeAttr('disabled')
    if ($(namesbox).val() === "") {
      alert("No More Entries Left");
    } else {
        udateEntries();
    }
    $("#entries").html(`${arr.length} Entries`)
    $("#entries").fadeIn("slow")
}

/*
this function saves the draw result to and array
*/
function save() {
    if (text === "" | text === undefined) {
    } else {
        rsults.push(text);
        let numlist = arr[0];
        /*
        Empty the random copy of the main data array
        */
        arrRandCopy.length = 0;

        for (let i = 1; i < arr.length; i++) {
            let elem = arr[i];
            numlist = numlist + "\n" + elem;
        }
        $("#namesbox").val(numlist);
        /*
        Call the updateEntries function to apdate the main array
        */
        udateEntries();
        /**
         set the numlist to null to free up the memory
         */
        numlist=null;
    }

    $("#go-btn").removeAttr('disabled')
    $("#nameList").removeAttr('disabled')
    $("#shw-results").removeAttr('disabled')
}
function reset() {
    $.ajax({
        type:"GET",
        url:"/promotions-v.2/session/reset-session",
        beforeSend:()=>{

        },
        success:(response)=>{
          console.log(response)
            window.location.replace("")
        },
        error:(err)=>{
            alert(err.message)
        }

    })

}
/**
 * this function takes the values from the namebox textarea and apdates the  main data array
 *
 */
function udateEntries() {
    let nums = $("#namesbox").val();
    arr = nums.split(/\r?\n/);
    nums=null;
}


function Drawagain(){
    if(drawCount!==0){
        drawCount=drawCount-1;
    }
    setTimeout(() => {
        $('#result1').animate({ top: '0' }, 4000);
        $("div").remove("#result1");
        $("div").remove(".name");
        $("div").remove(".extra");
        $("#values").html("");
        Draw()
    }, 1000)
}


function loadEntries(){
// loadentries
    //$("#dataFile").click()

    arr.length=0;
    try{
        $.ajax({
          type: 'GET',
          url: '/promotions-v.2/sessions/loadentries',

        beforeSend:()=>{
            $("#entries").html("<img src='/promotions-v.2/public/images/bars.svg'/>")
            $("#entries").append("<p>Loading Entries...<p>")
        },
        success: (response) => {
             let resData=JSON.parse(response);

          if(resData.status==="error"){
             //$("#entries").html("")
           setTimeout(()=>{
                alert(resData.message)
           },1000)


          }else {
            // console.log(response)
            $("#app").css({"background":"url(/promotions-v.2/public/images/light3.jpg)"})
            const resnums=resData.message;

                    for(let i=0; i<resnums.length; i++){
                        arr.push(resnums[i])
                    }

                    resData="";

                    let nums = arr[0];
                    /*
                      Loop through the data array and set line breaks to each elements
                      starting from the second element of the array
                    */
                    for (let i = 1; i < arr.length; i++) {
                        let number = arr[i];
                        nums = nums + "\n" + number;
                    }

                    /*Set the Values of the Text box with  nums*/
                    // $(body).css({"background":""})
                    $(namesbox).val(nums)
                 setTimeout(()=>{
                $("#entries").html("")
                    /* Loop through the response data array and store each element into  main data array arr[]*/


            },500)

            setTimeout(() => {

                $("#entries").html(`${arr.length} Entries  Loaded`)
                 $("#entries").show()
                $(dropdown).fadeIn("slow")
                $(namesbox).fadeIn("slow")
                $(namesbox).removeAttr("disabled")
                $('#headline').slideUp();
                $("#nav-buttons").removeClass("even-2");
                $("#nav-buttons").addClass("even-4");
                $("#go-btn").fadeIn("slow")
                $("#reset").fadeIn("slow")
                $("#nameList").show()
                $("#upload").removeClass('btn-primary')
                $("#upload").addClass('btn-outline-primary')
                $("#upload").hide()
                $("#loadentries").hide()
                $("#save-and-update").show()
                $("#varnote").slideUp("fast");
                $("#main-nav").css({ "margin-top": "20px" });
                $('#app').fullscreen();

            },1000)
          }
        },
    })
    }catch(ERR){
     alert(ERR.message)
    }
}
