export const formatDateForHumans = (date) => {
    const dateFormat = new Date(date);
    return dateFormat.toLocaleDateString('es-DO', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      })
  }