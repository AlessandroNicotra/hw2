const rating = document.querySelector("div.stelle")
const stelle = document.querySelectorAll('span.stella')
stelle.forEach(star =>{
    star.addEventListener('click', rate)
    star.addEventListener('mouseover', rate_hover)
    if(star.id <= rating.id) star.innerHTML = '&#9733;'
})
const div_rate = document.querySelector('div.rate')
div_rate.addEventListener('mouseout', out_rate)

const like = document.querySelector('div.button#like')
like.addEventListener('click', like_e)
const visto = document.querySelector('div.button#visto')
visto.addEventListener('click', visto_e)
const watchlist = document.querySelector('div.button#watchlist')
watchlist.addEventListener('click', watchlist_e)

const tag_poster = document.querySelector('div.poster').children[0].tagName;
const titolo = document.querySelector("span.titolo")
const film_id = document.querySelector("div.movie")

function visto_e(event){
    let simbolo = event.currentTarget.querySelector('span.simbolo')
    if(simbolo.id === '0'){
        simbolo.innerHTML = '&#9733;'
        simbolo.id = '1'
    }
    else if(simbolo.id === '1'){
        simbolo.innerHTML = '&#9734;'
        simbolo.id = '0'
    }
    var xmlhttp = new XMLHttpRequest();
    if(tag_poster === 'P'){
        xmlhttp.open("GET", "/setmovie/" + titolo.textContent.toString() + "/" + film_id.id + "/null/visto/" + simbolo.id , true);
        xmlhttp.send();
    }
    else{
        const poster = document.querySelector("img.poster").src
        const p_arr = poster.split("/")
        xmlhttp.open("GET", "/setmovie/" + titolo.textContent.toString() + "/" + film_id.id + "/" + p_arr[5] + "/visto/" + simbolo.id , true);
        xmlhttp.send();
    }
}

function watchlist_e(event){
    let simbolo = event.currentTarget.querySelector('span.simbolo')
    if(simbolo.id === '0'){
        simbolo.innerHTML = '&#9745;'
        simbolo.id = '1'
    }
    else if (simbolo.id === '1'){
        simbolo.innerHTML = '&#9746;'
        simbolo.id = '0'
    }
    var xmlhttp = new XMLHttpRequest();
    if(tag_poster === 'P'){
        xmlhttp.open("GET", "/setmovie/" + titolo.textContent.toString() + "/" + film_id.id + "/null" + "/watchlist/" + simbolo.id , true);
        xmlhttp.send();
    }
    else{
        const poster = document.querySelector("img.poster").src
        const p_arr = poster.split("/")
        xmlhttp.open("GET", "/setmovie/" + titolo.textContent.toString() + "/" + film_id.id + "/" + p_arr[5] + "/watchlist/" + simbolo.id , true);
        xmlhttp.send();
    }
}

function like_e(event){
    let simbolo = event.currentTarget.querySelector('span.simbolo')
    if(simbolo.id === '0'){
        simbolo.innerHTML = '&#9829;'
        simbolo.id = '1'
    }
    else if(simbolo.id === '1'){
        simbolo.innerHTML = '&#9825;'
        simbolo.id = '0'
    }
    var xmlhttp = new XMLHttpRequest();
    if(tag_poster === 'P'){
        xmlhttp.open("GET", "/setmovie/" + titolo.textContent.toString() + "/" + film_id.id + "/null" + "/piace/" + simbolo.id , true);
        xmlhttp.send();
    }
    else{
        const poster = document.querySelector("img.poster").src
        const p_arr = poster.split("/")
        xmlhttp.open("GET", "/setmovie/" + titolo.textContent.toString() + "/" + film_id.id + "/" + p_arr[5] + "/piace/" + simbolo.id , true);
        xmlhttp.send();
    }
}


function rate_hover(event){
    let parent = event.currentTarget.parentNode;
    const stelle = parent.querySelectorAll("span.stella")

    for(let i = 0; i < stelle.length; i++){
        stelle[i].innerHTML = '&#9734;'
    }

    for(let i = 0; i < event.currentTarget.id; i++){
        if(stelle[i].id <= event.currentTarget.id){
            stelle[i].innerHTML = '&#9733;'
        }
    }
}

function out_rate(event){
    let d = event.currentTarget
    const stelle = d.querySelectorAll("span.stella")
    for(let i = 0; i < stelle.length; i++){
        stelle[i].innerHTML = '&#9734;'
    }
    for(let i = 0; i < rating.id; i++){
        stelle[i].innerHTML = '&#9733;'
    }
}

function rate(event){
    let rate = event.currentTarget.id
    var xmlhttp = new XMLHttpRequest();
    if(document.querySelector('div.poster').children[0].tagName === 'P'){
        xmlhttp.open("GET", "/setmovie/" + titolo.textContent.toString() + "/" + film_id.id + "/null" + "/rating/" + rate , true);
        xmlhttp.send();
    }
    else{
        const poster = document.querySelector("img.poster").src
        const p_arr = poster.split("/")
        xmlhttp.open("GET", "/setmovie/" + titolo.textContent.toString() + "/" + film_id.id + "/" + p_arr[5] + "/rating/" + rate , true);
        xmlhttp.send();
    }
    rating.id = rate
    for(let i = 0; i < rate; i++){
        stelle[i].innerHTML = '&#9733;'
    }
    for(let i = rate; i < stelle.length; i++){
        stelle[i].innerHTML = '&#9734;'
    }
}
