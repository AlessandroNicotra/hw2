const stelle = document.querySelectorAll('span.stella')
stelle.forEach(star =>{
    star.addEventListener('mouseover', rate_hover)
    star.addEventListener('click', rate)
    let p = star.parentNode
    if(star.id <= p.title) star.innerHTML = '&#9733;'
})
const overlay = document.querySelectorAll('div.rating_overlay')
overlay.forEach(over =>{
    over.addEventListener('mouseout', out_rate)
})

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
    for(let i = 0; i < d.title; i++){
        stelle[i].innerHTML = '&#9733;'
    }
}

function rate(event){
    let rating = event.currentTarget.id
    let parent = event.currentTarget.parentNode
    parent.title = rating
    overlay.forEach(over =>{
        if(over.id === parent.id){
            over.title = rating
            const stelle = over.querySelectorAll("span.stella")
            for(let i = 0; i < stelle.length; i++){
                stelle[i].innerHTML = '&#9734;'

            }
            for(let i = 0; i < over.title; i++){
                stelle[i].innerHTML = '&#9733;'
            }
        }
    })
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "/setrate/" + parent.id +  "/" + rating , true);
    xmlhttp.send();
}
