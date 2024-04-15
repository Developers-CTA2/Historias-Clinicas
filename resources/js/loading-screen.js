const loading = $(".loading");
const ldsRing = $(".lds-ring");

export function activeLoading() {
    loading.addClass("active");
    ldsRing.removeClass("disable");
}

export function disableLoading() {
    loading.removeClass("active");
    ldsRing.addClass("disable");
}

window.addEventListener('load', function() {
    var container = document.querySelector('.container');
    container.classList.remove('loading');
});
