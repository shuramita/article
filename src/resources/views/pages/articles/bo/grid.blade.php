<section class="article grid">
    <div class="container">
        <div class="row">
            <div class="header-line">
                <span>WAGON VIỆT NAM</span>
                <div class="line"></div>
            </div>
            <div class="articles-list">
                @foreach($articles as $article)
                    @include('modules.article.grid-single')
                @endforeach
            </div>
            <div class="pagination">
                {{$articles->links()}}
            </div>
        </div>

    </div>

</section>
