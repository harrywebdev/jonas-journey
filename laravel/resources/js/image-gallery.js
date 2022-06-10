export function showGallery(images) {
    var domImages = images.map(createImageFromMarkdown).filter(item => item);
    var galleryElement = document.querySelector('.js-image-gallery');

    if (!galleryElement) {
        return;
    }

    galleryElement.textContent = '';
    domImages.forEach(function appendImageToGallery(img) {
        galleryElement.appendChild(img);
    });
}

function createImageFromMarkdown(markdownString) {
    var data = markdownString.match(/!\[[^\]]*\]\((?<filename>.*?)(?=\"|\))(?<optionalpart>\".*\")?\)/);

    if (!data) {
        return;
    }

    var imageElement = new Image();
    imageElement.src = data.groups.filename;
    imageElement.alt = data.groups.filename;
    imageElement.title = data.groups.filename;

    imageElement.addEventListener('click', function copyImageMarkdownToClipboard() {
        navigator.clipboard.writeText(`![](${this.getAttribute('alt')})`);
    })

    return imageElement;
}
