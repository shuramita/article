{{--TODO: The controll should allow runing dependence--}}
<section name="module" js="photo" css="photoCSS" class="photos">
    <div class="card">
        <div class="card-body row">
            <div class="col-md-12">
                <div class="preview-photos">
                    @if(isset($content->photos) && count($content->photos) > 0 )
                        @php $photos = json_decode($content->photos);@endphp
                        @foreach($photos as $photo)
                            @include('Article::controls.photo-preview',['photo'=>$photo])
                        @endforeach
                    @endif

                </div>
                <div class="photo add-more dz-preview dz-image-preview">
                    <div class="dz-image"><span  id="uploadZone" class="add-more-button btn btn-primary" @isset($content->photos) data-photos='{{$content->photos}}' @endisset> Add photo</span></div>
                </div>
            </div>

        </div>
    </div>
</section>