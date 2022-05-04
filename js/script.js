const contentblock = document.querySelector(".infoblock")
const redactOrcreateBlock = document.querySelector(".createORcorect")
const infoblock = document.querySelector(".info")
const infoblockHEADER = document.querySelector(".info > header")
const redactBtn = infoblock.querySelector("#redactBtn")

infoblockHEADER.addEventListener("mousedown", ()=> infoblock.addEventListener("mousemove", onDarg))
infoblockHEADER.addEventListener("mouseup", ()=> infoblock.removeEventListener("mousemove", onDarg))


function onDarg({movementX, movementY}){

    let getStyle = window.getComputedStyle(infoblock);
    let left = parseInt(getStyle.left)
    let top = parseInt(getStyle.top)
    infoblock.style.left = `${left + movementX}px`
    infoblock.style.top = `${top + movementY}px`
}


var date;
var time;
var text;
var id;
var redact = false

redactBtn.addEventListener("click", ()=>{
    toggleInfoPole()
    redact = !redact ? substitution(date, time, text) : false

})

const tasks = document.querySelectorAll("#task");




tasks.forEach(element => {
    element.addEventListener('click', ()=>accommodation(element))
});





function accommodation(element) {
    redact = false
    contentblock.removeAttribute("hidden")
    redactOrcreateBlock.setAttribute("hidden", "hidden")
    redactBtn.children[0].className = "fas fa-edit"
    var textArray = element.innerText.split("\n")
    text = textArray[0]
    date = textArray[1]
    time = textArray[2]
    const id = element.querySelector("#id").value;
    redactOrcreateBlock.querySelector("#idForm").value = id
    infoblock.querySelector(".content").innerText = text
    infoblock.querySelector(".dataAndtime").innerHTML = 'Заплонировано на <span class="data-time">' + date +'</span>  в <span class="data-time">'+ time+'</span> '
    infoblock.querySelector("#delEl").href = "index.php?id=" + id
}


function substitution(ThisDate, ThisTime, ThisText){
    redactOrcreateBlock.querySelector("#date").value = ThisDate.split(".").reverse().join("-")
    redactOrcreateBlock.querySelector("#time").value = ThisTime
    redactOrcreateBlock.querySelector("#contentArea").textContent = ThisText
    
    return true
}


document.querySelector("#addTask").addEventListener("click", 
    ()=>{
    redactBtn.children[0].className = redactBtn.children[0].className = "fas fa-times"
    contentblock.setAttribute("hidden", "hidden")
    redactOrcreateBlock.removeAttribute("hidden")
    redactOrcreateBlock.querySelector("#idForm").value = null
    substitution("", "", "")
    }
)



function toggleInfoPole() {
    redactBtn.children[0].className = redactBtn.children[0].className == "fas fa-edit" ? "fas fa-times" : "fas fa-edit"
    contentblock.toggleAttribute("hidden")
    redactOrcreateBlock.toggleAttribute("hidden");
}