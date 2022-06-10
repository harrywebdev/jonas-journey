export function preventDefaults(e) {
    e.preventDefault()
    e.stopPropagation()
}

export function highlight(el) {
    el.classList.add('highlight')
}

export function unhighlight(el) {
    el.classList.remove('highlight')
}

export function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}
