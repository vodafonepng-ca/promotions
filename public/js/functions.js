"use strict";
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
     showloadDataFiles();
    if (arr.length === 0) {
        $(dropdown).fadeIn("slow")
        $("#headline").html("Etries not available")
        setTimeout(()=>{
            $("#headline").html("")
        },1000)
    } else {
        $(dropdown).fadeIn("slow")
        $(namesbox).fadeIn("slow")
        $(namesbox).removeAttr("disabled")
        $('#headline').slideUp();
    }
})
$("#upload").on("click", () => {
    $("#dataFile").click()
})
$("#go-btn").on("click", () => {
    $("#shw-results").show()
    Draw()
})
$("#shw-results").on("click", () => {
    $("#modal-1-body").html("")
    $("#modal-1").fadeIn("slow")

    $("#modal-1-body").html("<div>Luky Winners <button class='btn' id='dlbtn' onClick='DownloadResults()'>Download Resuls</buttton> </div><hr>")

    for (let i = 0; i < rsults.length; i++) {
        $("#modal-1-body").append(`<div class='card shadow-sm bg-success mb-2'><div class="card-body text-center"><span class="h2 text-white"> DRAW# ${i + 1}: ${rsults[i]}</span></div></div>`)
    }
     
})


$("#save-and-update").on("click", () => {
    $(namesbox).attr('disabled', 'disabled');
    saveEntries()

})


$("#dataFile").on("change", () => {
    $("#fileLoadingFrom").submit();
})


$("#fileLoadingFrom").on("submit", function (e) {

    $(dropdown).fadeIn("slow");

    $.ajax({
        type: 'POST',
        url: 'index.php',
        data: new FormData(this),
        dataType: false,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: () => {
            $("#entries").html("<img src='/images/loading.gif'/>")
            $("#entries").append("<p>Loading File.....<p>")
        },

        success: (response) => {
            $("#fileLoadingFrom")[0].reset();
            $("#fileLoadingFrom").fadeOut()
            let resData = JSON.parse(response)
            resData.map((key) => {
                arr.push(key)
            })

            let nums = "";
            for (let i = 0; i < arr.length; i++) {
                let number = arr[i];
                nums = nums + "\n" + number;
            }
            $(namesbox).val(nums)
            setTimeout(() => {
                $('#entries').html('');
            }, 500)
            setTimeout(() => {
                $("#entries").html(`${arr.length} Entries Loaded`)
                $(namesbox).fadeIn("slow")
                $("#go-btn").fadeIn("slow")
                
                $("#upload").hide()
                $("#save-and-update").show()
                $("#varnote").slideUp("fast");
                $("#main-nav").css({ "padding-top": "5px" });

            }, 500)
        }
    });
    e.preventDefault();

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
        url: 'index.php',
        data:{results:dt} ,
        
        beforeSend: () => {
            
        },

        success: (response) => {
            var blob = new Blob([response])
           
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
        link.download = fileName;
        link.click();
        rsults=[];
        $("#modal-1-body").html("");
        $("#modal-1").fadeOut("slow")
        count=0;
        },
        error:(e)=>{
            console.log(e.message)
        }
    })
}
function Draw() {
    $("#entries").fadeOut("slow")
    drawCount = drawCount + 1;
    arrRandCopy = makeRandArrayCopy(arr);
    if ($(namesbox).val() === '' && arr.length === 0) {
        alert("No Entries at the Moment")
    } else {
        $("#go-btn").attr('disabled', 'disabled')
        $('#headline').hide();
        const randIndex = Math.round(Math.random() * arr.length)
        const atrelem = arr[randIndex];
        if (arr[randIndex] === "" || arr[randIndex] === undefined) {
        } else {
            var ind = arr.indexOf(arr[randIndex]);
            arr.splice(ind, 1)
            let count = 1;
            count = 1;
            $("#values").show();
            $(".name").show();
            $("#dropdown").show();
            $("div").remove(".name");
            $("div").remove(".extra");
            $("#playback").html("");
            $(namesbox).slideUp(100)
            let newtop = arrRandCopy.length * 200 * -1;
            $('#values').css({ top: + newtop });
            arr.sort(randOrd);
            for (var i in arrRandCopy) {
                if (arrRandCopy[i] == "" || typeof (arrRandCopy[i]) == undefined) {
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
            text = atrelem;
            if (arr.length !== 0) {
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

function standout(text, count) {

    $('.name').animate({ opacity: 100 });
    $('#result1').animate({ height: '+=600px' }, "fast");
    // $('#result1').html("");
    $('#result1').html(`<p class='animate-charcter'>${text}</p>`)
    
    $('#result1').append('<p><a class="btn btn-outline-info" href="#" onClick="removevictim();">Save Winner</a></p>');
    $('#go').removeAttr('disabled', 'disabled');
    $('#list').removeAttr('disabled', 'disabled');
    $('#save').removeAttr('disabled', 'disabled');
    $('#headline').html(`<p class='animate-charcter'>Winner # ${count} </p>`);
    $('#headline').show();
}


function removevictim() {
    save();
    
    setTimeout(() => {
        $('#result1').fadeOut();
        $("div").remove("#result1");
        $("div").remove(".name");
        $("div").remove(".extra");
        $("#values").html("");
        $('#headline').html('<p class="text-secondary " id="saved-txt">Winner Saved &#128522;</p><p class="text-primary"> Click GO for next roll.<p>');
    }, 1000)
}

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


function saveEntries() {
    var nameupdated = "";
    $("#go-btn").removeAttr('disabled')
    if ($(namesbox).val() === "") {
    } else {
        udateEntries();
    }
    $("#entries").html(`${arr.length} Entries`)
}
function save() {
    if (text === "" | text === undefined) {
    } else {
        rsults.push(text);
        let numlist = "";
        arrRandCopy.length = 0;
        for (let i = 0; i < arr.length; i++) {
            let elem = arr[i];
            numlist = numlist + "\n" + elem;
        }
        $("#namesbox").val(numlist);
        udateEntries();
    }

    $("#go-btn").removeAttr('disabled')

}
function reset() {
    window.location.replace("")
}

function udateEntries() {
    let nums = $("#namesbox").val();
    arr = nums.split(/\r?\n/);
}

function showloadDataFiles(){
    $.ajax({
        method:"GET",
        url:"index.php?pa=entryfiles",
        beforeSend:()=>{

        },
        success:(res)=>{
            console.log(res)
        },
        error:(err)=>{
            console.log(err.message);
        }
    })
}