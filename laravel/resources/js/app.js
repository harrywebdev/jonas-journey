/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const {preventDefaults, highlight, unhighlight} = require('./utils');
const {imageUpload} = require('./image-upload');
const {showGallery} = require('./image-gallery');

var imageUploadText = document.querySelector('.js-image-upload-textarea');
if (imageUploadText) {
    imageUploadText.addEventListener('input', imageUploadTextOnInput);
    imageUploadTextOnInput.bind(imageUploadText)();

    function imageUploadTextOnInput() {
        var images = this.value.match(/!\[[^\]]*\]\((?<filename>.*?)(?=\"|\))(?<optionalpart>\".*\")?\)/g);
        if (!images) {
            return;
        }

        showGallery(images);
    }
}

var imageUploadInput = document.querySelector('.js-image-upload-input');
if (imageUploadInput && imageUploadText) {
    imageUploadInput.addEventListener('change', function imageUploadInputOnChange() {
        imageUpload(this.files, imageUploadText);
    });
}

var imageUploadArea = document.querySelector('.js-image-upload-area');
if (imageUploadArea && imageUploadText) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        imageUploadArea.addEventListener(eventName, preventDefaults, false)
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        imageUploadArea.addEventListener(eventName, highlight.bind(this, imageUploadArea), false)
    });

    ['dragleave', 'drop'].forEach(eventName => {
        imageUploadArea.addEventListener(eventName, unhighlight.bind(this, imageUploadArea), false)
    });

    imageUploadArea.addEventListener('drop', handleDrop, false)

    function handleDrop(e) {
        let dt = e.dataTransfer;
        let files = dt.files;

        imageUpload(files, imageUploadText);
    }
}

