{gc:extends file="main"/}
<h1 class="standalone-title">Parcourir les catégories</h1>
<div class="page">
    {gc:foreach var="$categories" as="$category"}
        <div class="enigme-list stack twisted">
            <a href="{{url:kryptonite.category.category:$category->id,slugify($category->title)}}">
                <div class="content">
                    <div class="title">{$category->title}</div>
                    <div class="picture">
                        <img src="/{$category->logo}" alt="">
                    </div>
                </div>
            </a>
        </div>
    {/gc:foreach}
    <div class="clear"></div>
</div>