<div class="modal fade" id="{{$modalId}}" tabindex="-1" aria-labelledby="{{$modalId}}Label" aria-hidden="false" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title" id="{{$modalId}}Label">{{$modalTitle}}</h5>
                <button type="button" class="btn-custom-close" data-bs-dismiss="modal" ><svg
                        xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                        <path fill="#ffffff"
                            d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                    </svg></button>
            </div>
            <div class="modal-body">
                    {{-- Alerta de edicion  --}}
                <div class="alert alert-danger d-none" role="alert" id="{{$errorAlertId}}"></div>

                <form action="{{$routeForm}}" method="{{$methodForm}}" name="{{$formId}}" id="{{$formId}}">
                    @csrf
                    @if (isset($isMethodPut) && $isMethodPut)
                        @method('PUT')
                    @endif
                    <input type="hidden" name="fecha" value="{{ $dateCita }}">

                    <div class="row">
                        {{$slot}}
                    </div>

                    <div class="modal-footer">

                        <x-button-custom type="button"
                            class="btn-red justify-content-center justify-content-lg-start disabled-custom"
                            text="Cancelar" tooltipText="Cancelar acción" data-bs-dismiss="modal">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    viewBox="0 0 32 32">
                                    <path fill="currentColor"
                                        d="M17.414 16L24 9.414L22.586 8L16 14.586L9.414 8L8 9.414L14.586 16L8 22.586L9.414 24L16 17.414L22.586 24L24 22.586z" />
                                </svg>
                            </x-slot>
                        </x-button-custom>

                        <x-button-custom typeButton="submit" type="submit"
                            class="btn-blue justify-content-center justify-content-lg-start disabled-custom"
                            text="{{$buttonSubmitText}}" tooltipText="{{$buttonSubmitText}}">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    viewBox="0 0 20 20">
                                    <path fill="currentColor"
                                        d="m15.3 5.3l-6.8 6.8l-2.8-2.8l-1.4 1.4l4.2 4.2l8.2-8.2z" />
                                </svg>
                            </x-slot>
                        </x-button-custom>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
