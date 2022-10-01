const imagePreview = document.getElementById('image-preview');
const imageField = document.getElementById('image-field');
const placeholder = "https://troianiortodonzia.it/wp-content/uploads/2016/10/orionthemes-placeholder-image.png";

imageField.addEventListener('input', () => {
    imagePreview.src = imageField.value ?? placeholder;
})