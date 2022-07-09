const reg_b = document.querySelector("button.reg")
const log_b = document.querySelector("button.log")
const log_p = document.querySelector("p#log")
const reg_p = document.querySelector("p#reg")
const form_r = document.querySelector("form.registra")
const form_l = document.querySelector("form.login")
const buttons = document.querySelector("div#button")
const div_ns = document.querySelector("div.no_session")
reg_b.addEventListener('click', registra_b);
log_b.addEventListener('click', login_b);
reg_p.addEventListener('click', registra_b);
log_p.addEventListener('click', login_b);
const media700 = window.matchMedia("(max-width: 700px)")
const media500 = window.matchMedia("(max-width: 500px)")

function registra_b(){
    buttons.style.display = "none"
    form_l.style.display = "none"
    form_r.style.display = "flex"
    if(media700.matches){
        div_ns.style.height = "640px"
    }
    else{
        div_ns.style.height = "620px"
    }
}
function login_b(){
    buttons.style.display = "none"
    form_l.style.display = "flex"
    form_r.style.display = "none"
    if(media500.matches){
        div_ns.style.height = "340px"
    }
    else{
        div_ns.style.height = "290px"
    }
}
