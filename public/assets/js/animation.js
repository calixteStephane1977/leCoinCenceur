// const article = document.getElementsByTagName("p")

const textDisplay =document.querySelector('span.para');
console.log(textDisplay);
const phrase =['Hello,my name is Ania.','I love to code.','I love to teach code.']
console.log(phrase);
let i=0;
let j=0;
let currentPhrase=[];
function loop(){
    if(i<phrase.length){
        if(j<=phrase[i].length){
            console.log(phrase[i][j]);
            textDisplay.push(phrase[i][j])
            currentPhrase.push(phrase[i][j])
            j++
        }
        if(j==phrase[i].length){
            
            i++
        }
    }
    textDisplay.innerHTML=currentPhrase.join(" ");
    setTimeout(loop, 500)
}
loop();












// function loop(){
//     textDisplay.innerHTML=currentPhrase
//  if(i<textDisplay.innerText.length){
    
//     if(j<textDisplay.innerText[i]){
//         currentPhrase.push(textDisplay.innerText[i][j])
//         j++
//     }
//     if(j==textDisplay.innerText[i].length){
//             i++
//     }
//  }
//  setTimeout(loop, 500)
// }
// loop()