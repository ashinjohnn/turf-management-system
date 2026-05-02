let dates = document.querySelectorAll('.dateSelect .date')
            for(let i=0; i<dates.length; i++){
                dates[i].addEventListener('click', ()=>{
                for(let j=0; j<dates.length; j++){
                    dates[j].classList.remove('active')
                }
                dates[i].classList.add('active');
                })
            }

let time = document.querySelectorAll('.selectTime .time');

    for (let i = 0; i < time.length; i++) {
        time[i].addEventListener('click', () => {
            if (!time[i].classList.contains('booked')) {
                time[i].classList.toggle('active');
            }
        });
    }
            