/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
let menuResp = document.getElementById("menuresp");
menuResp.addEventListener('click',function(){
    if (menuResp.className === "haut-navigation-liste") {
        menuResp.className += " responsively";
    } else {
        menuResp.className = "haut-navigation-liste";
    }
})
// function fonctionresponsively() {
//     // let x = document.getElementById("menuresp");
//     if (x.className === "haut-navigation-liste") {
//         x.className += " responsively";
//     } else {
//         x.className = "haut-navigation-liste";
//     }
// }