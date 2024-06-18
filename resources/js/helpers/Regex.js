/* Expresiones regulares para validar los datos */
export const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(.{4,})$/;
export const regexLetters = /^[a-zA-ZáÁéÉíÍóÓúÚÑñ ]+$/;
export const regexCode = /^[0-9]{7,10}$/;

export const regexNumero = /^(?=.*\d)/;
export const regexFecha = /^\d{4}-\d{2}-\d{2}$/;
export const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
export const regexDecimal = /^(?=.*\d)(?:\d*\.\d+|\d+)$/;
export const regexTelefono = /^[0-9]{10}$/;

export const regexNss = /^[0-9]{11}$/;
export const regexDescription = /^[a-zA-Z0-9\s.,;:?!'"\-()@#&]+$/;

export const regexNumeroEntero = /^\d+$/;
export const regexNumlenght2 = /^[0-9]{1,2}$/;
export const regexAnio = /^[0-9]{4}$/;
export const regexCp = /^[0-9]{5}$/;
