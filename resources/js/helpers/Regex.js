/* Expresiones regulares para validar los datos */
export const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(.{4,})$/;
export const regexLetters = /^[a-zA-ZáÁéÉíÍóÓúÚÑñ ]+$/;
export const regexCode = /^[0-9]{7,10}$/;
export const regexLetrasHorario = /^[a-zA-ZáÁéÉíÍóÓúÚÑñ\s-]+$/;
export const regexHorario = /^\d{2}:\d{2}\s-\s\d{2}:\d{2}$/;

export const regexNumero = /^(?=.*\d)/;
export const regexFecha = /^\d{4}-\d{2}-\d{2}$/;
export const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
export const regexDecimal = /^(?=.*\d)(?:\d*\.\d+|\d+)$/;
export const regexTelefono = /^[0-9]{10}$/;

export const regexNss = /^[0-9]{11}$/;
