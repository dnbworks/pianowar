

const inputFile = document.querySelector("input[type='file']");
const previewContainer = document.querySelector('.screenshot');
const previewImage = previewContainer.querySelector('img');
const previewText = previewContainer.querySelector('span');

inputFile.addEventListener("change", function(){
    const file = this.files[0];

    // console.log(file);

    if(file){
        const reader = new FileReader();

        previewText.style.display = "none";
        previewImage.style.display = "block";

        reader.addEventListener("load", function(){
            previewImage.setAttribute("src", this.result);
            // console.log(this);
        });

        reader.readAsDataURL(file);
    } else {
        previewText.style.display = null;
        previewImage.style.display = null;

        previewImage.setAttribute("src", "");
    }
});