/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('.message a').click(function () {
        console.log("Entre a el login");
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
});
function cambia() {
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
}

