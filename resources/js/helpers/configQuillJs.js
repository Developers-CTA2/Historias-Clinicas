const toolbarOptions = [
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],        // Encabezados
    ['bold', 'italic', 'underline', 'strike'],        // Formatos de texto
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],     // Listas
    ['clean'],                                        // Eliminar formato
  ];

export const options = (placeholder) => {
    return {
    theme: 'snow',
    placeholder: placeholder,
    modules : {
      toolbar : toolbarOptions
    }
  }
}