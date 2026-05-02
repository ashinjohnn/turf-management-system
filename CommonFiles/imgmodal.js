function showImage(imageData) {
    var modal = document.getElementById("imageModal");
    var modalImage = document.getElementById("modalImage");

    // Set the image source to the base64-encoded data
    modalImage.src = "data:image/jpeg;base64," + imageData;

    // Display the modal
    modal.style.display = "block";
  }

  // Function to close the image modal
  function closeImageModal() {
    var modal = document.getElementById("imageModal");
    modal.style.display = "none";
  }

  window.addEventListener('click', outsideClick);

  function outsideClick(e){
    var modal = document.getElementById("imageModal");
    if(e.target == modal){
    modal.style.display = 'none';
    }
}