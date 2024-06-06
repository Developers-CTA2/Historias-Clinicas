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

 
