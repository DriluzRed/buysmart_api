<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($sliders as $index => $slider)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <a href="{{ $slider->slug }}">
                    <img src="{{ asset($slider->banner_image) }}" class="d-block w-100" alt="Slider Image">
                </a>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>