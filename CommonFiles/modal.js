//Get the modal elements
var modal = document.getElementById('Modal');
//Get open modal Button
// var modalBtns = document.querySelectorAll('.modalBtn');
//get close button
var closeBtn = document.getElementById('ModalClose');

//listen for open click
// modalBtn.addEventListener('click', openModal);
// modalBtns.forEach(function(btn) {
//     btn.addEventListener('click', openModal);
// });

//listen for close click
closeBtn.addEventListener('click', closeModal);

//listen for outside click
window.addEventListener('click', outsideClick);
 
//function to open modal
function openModal(){
    modal.style.display = 'block';
}

//function to close modal
function closeModal(){
    modal.style.display = 'none';

}

//function to close modal outside click
function outsideClick(e){
    if(e.target == modal){
    modal.style.display = 'none';
    }
}

