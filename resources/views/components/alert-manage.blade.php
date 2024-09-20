     <div class="d-flex justify-content-between">
        <div>
            <div class="p-0 m-0 {{ $containerClass }} d-none animate__animated animate__fadeInUp">
                <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between p-0 m-0"
                    role="alert">
                    <p class="p-2 mb-0 me-3 {{ $textClass }}">
                        {{ $slot }}
                    </p>
                </div>
            </div>
        </div>
    </div>
 