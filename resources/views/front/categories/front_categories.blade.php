
<?php 
use App\Models\Category;
$categories = Category::categories();
/*echo "<pre>"; print_r($categories); die;*/
?>

<section class="p-3">
    <div class="row"> 
        <img class="img-fluid col" src="{{ asset('images/front_images/category.jpg') }}" alt="">
    </div>
    <ul class="row row-cols-3">
        @foreach($categories as $category)
        <li class="col g-1">
            @if(!empty($category['category_image']))
            <a href="{{ $category['url'] }}"> <img class="img-fluid" src="{{ asset('images/category_images/'.$category['category_image']) }}" alt=""> </a>
            @else
            <img class="img-fluid" src="{{ asset('images/category_images/dummy.png') }}"  alt="">
            @endif
            </a>
        </li>
        @endforeach
    </ul>
</section>