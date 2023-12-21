
const startingMinute = 1;
let time = startingMinute * 60;

const countDown = document.getElementById('CountDown');

setInterval(UpdateCountDown , 1000);

function UpdateCountDown(){
    
    const minutes = Math.floor(time / 60);
    let seconds = time % 60;
    seconds = seconds < 1 ? '0' + seconds :seconds;
    countDown.innerHTML = `${minutes}:${seconds}`;
    if(time > 0.00){

        time--;

    }

}