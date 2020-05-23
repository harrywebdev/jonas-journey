const {getCsrfToken} = require('./utils');

export function imageUpload(files, targetTextArea) {
    [...files].forEach(uploadImage.bind(this, targetTextArea));
}

async function uploadImage(targetTextArea, file) {
    let url = '/image';
    let formData = new FormData()

    formData.append('file', file)

    try {
        let response = await fetch(url, {
            method: 'POST',
            headers: {
                'Accepts': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: formData
        });

        if (!response.ok) {
            return handleUploadError(response.statusText);
        }

        var data = await response.json();
        if (data && data.image && data.image.path) {
            var text = `![](/${data.image.path})`;
            targetTextArea.value += "\n\n" + text;
            await navigator.clipboard.writeText(text);
            return;
        }

        handleUploadError();
    } catch (e) {
        handleUploadError(e.message);
    }
}

function handleUploadError(msg) {
    console.error(msg || 'Unknown error');
    alert('To se nepovedlo :(');
}
