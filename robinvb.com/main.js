// var boxes = document.querySelectorAll(".box")
//
// console.log(boxes);
//
// boxes.forEach(function(box)  {
//     console.log(box);
//     box.addEventListener("mouseenter", function() {
//         console.log(this.textContent);
//         this.innerHTML = `<div class="content" style="text-align:right;">Les mer<i style="color: white; font-size: 4em; " class="fas fa-long-arrow-alt-right"></i></div>`;
//     })
//
//     box.addEventListener("mouseleave", function() {
//         console.log(this.textContent);
//         this.innerHTML = `<div class="content"><i class="fas fa-wrench"></i>dasd</div>`;
//         // ${this.textContent} == the new value, need prev.
//     })
// })


// show current page in menu

// <i class="fas fa-bars"></i>
// <i class="fas fa-bath"></i>
// <!-- <i class="fas fa-temperature-high"></i>
// <i class="fas fa-faucet"></i>
// <i class="fas fa-shower"></i> -->


function openNav() {
    document.getElementById("sidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("sidenav").style.width = "0";
}


var btns = document.querySelectorAll("nav li")
var a = document.querySelectorAll("nav li a")

btns.forEach((btn, i) => {
    btn.addEventListener("mouseover", () => {

    })
});

// event object pass. or global to read, like config, settings, paths
