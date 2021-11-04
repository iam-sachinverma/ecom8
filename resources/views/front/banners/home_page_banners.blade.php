<?php use App\Models\Banner; 
$getBanners =  Banner::getBanners();
/* echo "<pre>"; print_r($getBanners); die;*/
?>

<section class="px-3">
    <article class="banner">
        <div id="home_banner" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($getBanners as $key => $banner)
                    <div class="carousel-item @if($key==0) active @endif" data-bs-interval="3000">
                        <a @if(!empty($banner['link'])) href="{{ url($banner['link']) }}" @else href="javascript:void(0)" @endif>
                            <img src="{{ asset('images/banner_images/'.$banner['image']) }}" class="card-img rounded-0" style="height: 170px;" alt="{{ $banner['alt'] }}" title="{{ $banner['title'] }}">
                        </a>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#home_banner" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#home_banner" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
	</article>   
</section>
