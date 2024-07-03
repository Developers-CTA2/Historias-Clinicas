import DOMPurify from 'dompurify';

export const DomPurify = (html) => {
    return DOMPurify.sanitize(html);
}