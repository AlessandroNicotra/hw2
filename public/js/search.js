let page = document.querySelector('p.currpage').textContent
let maxpage = document.querySelector('p.maxpage').textContent
const prev_b = document.querySelector('p.prev')
const next_b = document.querySelector('p.next')
prev_b.addEventListener('click', prev)
next_b.addEventListener('click', next)
const search = document.querySelector('div.risultati').id

function prev(){
    if(page > 1){
        page--
        window.location.href = "/search/" + search + '/' + page
    }
}

function next(){
    if(page < maxpage){
        page++
        window.location.href = "/search/" + search + '/' + page
    }
}
